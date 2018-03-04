<?php

declare(strict_types=1);
require_once 'config/PHPMailer.php';
require_once 'config/LoginRegistration.php';

require_once 'libraries/PHPMailer.php';
require_once 'libraries/class.smtp.php';

error_reporting(E_ALL);
ini_set("display_errors", '1');
class UserModel extends Model 
{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection = null;
    /**
     * @var int $user_id The user's id
     */
    public $user_id = null;
    /**
     * @var string $user_name The user's name
     */
    public $user_name = "";
    /**
     * @var string $user_email The user's mail
     */
    public $user_email = "";
    /**
     * @var boolean $user_is_logged_in The user's login status
     */
    public $user_is_logged_in = false;
    /**
     * @var string $user_gravatar_image_url The user's gravatar profile pic url (or a default one)
     */
    public $user_gravatar_image_url = "";
    /**
     * @var string $user_gravatar_image_tag The user's gravatar profile pic url with <img ... /> around
     */
    public $user_gravatar_image_tag = "";
    /**
     * @var boolean $password_reset_link_is_valid Marker for view handling
     */
    public $password_reset_link_is_valid  = false;
    /**
     * @var boolean $password_reset_was_successful Marker for view handling
     */
    public $password_reset_was_successful = false;
    /**
     * @var bool success state of registration
    */
    public  $registration_successful  = false;
    /**
     * @var bool success state of verification
    */
    public  $verification_successful  = false;
    /**
     * @var array collection of error messages
    */
    public  $errors                   = array();
    /**
     * @var array collection of success / neutral messages
    */
    public  $messages                 = array();


    public function __construct()  
    {  
        $this->table_name = 'Users';
        parent::__construct($this);
    }

    // admin function
    public function getAllUsers()
    {
        return $this->all();
    }

    // admin function
    public function getUserByID($id)
    {
        return $this->where('user_id', '=', $id)->get();
    }

    /**
     * Checks if database connection is opened. If not, then this method tries to open it.
     * @return bool Success status of the database connecting process
     */
    public function databaseConnection()
    {
        // if connection already exists
        if ($this->db_connection != null) {
            return true;
        } else {
            try {
                include_once('Elegant/dbconfig.php');
                $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
                return true;
            } catch (PDOException $e) {
                $this->errors[] = MESSAGE_DATABASE_ERROR . $e->getMessage();
            }
        }
        // default return
        return false;
    }



    // Function to get the client IP address
    function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }



    public function registerNewUser($user_email, $user_type, $first_name, $last_name, $user_name, $user_password, $user_password_repeat, $captcha)
    {
        $error_occured = false;
        
        $user_name  = trim($user_name); // we just remove extra space on username and email

        // check provided data validity
        if (strtolower($captcha) != strtolower($_SESSION['captcha'])) 
        {
            $this->errors[] = MESSAGE_CAPTCHA_WRONG;
            $error_occured = true;
        } 
        if (empty($user_name)) 
        {
            $this->errors[] = MESSAGE_USERNAME_EMPTY;
            $error_occured = true;
        } 
        if (empty($user_password) || empty($user_password_repeat)) 
        {
            $this->errors[] = MESSAGE_PASSWORD_EMPTY;
            $error_occured = true;
        } 
        if ($user_password !== $user_password_repeat) 
        {
            $this->errors[] = MESSAGE_PASSWORD_BAD_CONFIRM;
            $error_occured = true;
        } 
        if (strlen($user_password) < MINIMUM_PASSWORD_LENGTH) 
        {
            $this->errors[] = MESSAGE_PASSWORD_TOO_SHORT;
            $error_occured = true;
        } 
        if (strlen($user_name) > 64 || strlen($user_name) < 5) 
        {
            $this->errors[] = MESSAGE_USERNAME_BAD_LENGTH;
            $error_occured = true;
        } 
        if (!preg_match('/^[a-z\d]{5,64}$/i', $user_name)) 
        {
            $this->errors[] = MESSAGE_USERNAME_INVALID;
            $error_occured = true;
        } 
        if (!isset($user_type)) 
        {
            $this->errors[] = "Please select the type of user you are registering as.";
            $error_occured = true;
        } 
        if ($user_type < 2 || 4 < $user_type) 
        {
            $this->errors[] = "You will be banned for attempting html injection.  Your ip address has been flagged.";
            $error_occured = true;
        }

        if ($error_occured) {
            return false;
        }
        


        // check if username or email already exists
        //   $query_check_user_name = $this->db_connection->prepare('SELECT user_name FROM users WHERE user_name=:user_name or user_email=:user_email');
        //   $query_check_user_name->bindValue(':user_name', $user_name, PDO::PARAM_STR);
        //   $query_check_user_name->bindValue(':user_email', $user_email, PDO::PARAM_STR);
        //   $query_check_user_name->execute();
        //   $result = $query_check_user_name->fetchAll();

        $result = $this->where('user_name', '=', $user_name)
                        ->orWhere('user_email', '=', $user_email)
                        ->get();

        // if username or/and email find in the database
        // TODO: this is really awful!
        if (count($result) > 0) 
        {
            for ($i = 0; $i < count($result); $i++) 
            {
                $this->errors[] = ($result[$i]->user_name== $user_name) ? MESSAGE_USERNAME_EXISTS : MESSAGE_EMAIL_ALREADY_EXISTS;
            }
        } 
        else 
        {
            $hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);

            $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
            $user_activation_hash = sha1(uniqid(mt_rand().'', true));

            // write new users data into database                                                                                                                                                                                                                                                                           
            // $query_new_user_insert = $this->db_connection->prepare('INSERT INTO users (user_email, user_type, first_name, last_name, user_name, user_password_hash, user_activation_hash, user_registration_ip, user_registration_datetime) VALUES(:user_email, :user_type, :first_name, :last_name, :user_name, :user_password_hash, :user_activation_hash, :user_registration_ip, now())'); 
        
            // $query_new_user_insert->bindValue(':user_email', $user_email, PDO::PARAM_STR);
            // $query_new_user_insert->bindValue(':user_type', $user_type, PDO::PARAM_INT);
            // $query_new_user_insert->bindValue(':first_name', $first_name, PDO::PARAM_STR);
            // $query_new_user_insert->bindValue(':last_name', $last_name, PDO::PARAM_STR); 
            // $query_new_user_insert->bindValue(':user_name', $user_name, PDO::PARAM_STR);
            // $query_new_user_insert->bindValue(':user_password_hash', $user_password_hash, PDO::PARAM_STR);
            // $query_new_user_insert->bindValue(':user_activation_hash', $user_activation_hash, PDO::PARAM_STR);

            $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : "unkown";

            // $query_new_user_insert->bindValue(':user_registration_ip', $ip, PDO::PARAM_STR);

            //$query_new_user_insert->execute();

            // id of new user
            //$user_id = $this->db_connection->lastInsertId();

            $this->user_email           = $user_email;
            $this->user_type            = $user_type;
            $this->first_name           = $first_name;
            $this->last_name            = $last_name;
            $this->user_name            = $user_name;
            $this->user_password_hash   = $user_password_hash;
            $this->user_activation_hash = $user_activation_hash;
            $this->user_registration_ip = $ip;
            $this->user_registration_datetime = date('Y-m-d H:i:s');
            $new_user_inserted = $this->save();

            if ($new_user_inserted) 
            {
                $this->messages[] = MESSAGE_REGISTRATION_SUCCESSFUL;
                $this->sendVerificationEmail($user_id, $user_email, $user_activation_hash);
                return true;
            } 
            else 
            {
                $this->errors[] = MESSAGE_REGISTRATION_FAILED;
                return false;
            }
        }
    }



    /**
     * Search into database for the user data of user_name specified as parameter
     * @return user data as an object if existing user
     * @return false if user_name is not found in the database
     * TODO: @devplanete This returns two different types. Maybe this is valid, but it feels bad. We should rework this.
     * TODO: @devplanete After some resarch I'm VERY sure that this is not good coding style! Please fix this.
     */
    public function getUserData($user_name)
    {
        // if database connection opened
        //if ($this->databaseConnection()) {
            // database query, getting all the info of the selected user
            //$query_user = $this->db_connection->prepare('SELECT * FROM users WHERE user_name = :user_name');
            //$query_user->bindValue(':user_name', $user_name, PDO::PARAM_STR);
            //$query_user->execute();
            // get result row (as an object)
            //return $query_user->fetchObject();
        //}// else {
            //return false;
        //}
        $result_row = $this->where('user_name', '=', $user_name)->get();
        if(count($result_row) == 0)
        {
          return false;
        }else{
          return  $result_row[0];// get result row (as an object)
        }
        
    }

    /**
     * Logs in with S_SESSION data.
     * Technically we are already logged in at that point of time, as the $_SESSION values already exist.
     */
    public function loginWithSessionData()
    {
        $this->user_name = $_SESSION['user_name'];
        $this->user_email = $_SESSION['user_email'];

        // set logged in status to true, because we just checked for this:
        // !empty($_SESSION['user_name']) && ($_SESSION['user_logged_in'] == 1)
        // when we called this method (in the constructor)
        $this->user_is_logged_in = true;
    }

    /**
     * Logs in via the Cookie
     * @return bool success state of cookie login
     */
    public function loginWithCookieData()
    {
        if (isset($_COOKIE['rememberme'])) {
            // extract data from the cookie
            list ($user_id, $token, $hash) = explode(':', $_COOKIE['rememberme']);
            // check cookie hash validity
            if ($hash == hash('sha256', $user_id . ':' . $token . COOKIE_SECRET_KEY) && !empty($token)) {
                // cookie looks good, try to select corresponding user
                if ($this->databaseConnection()) {
                    // get real token from database (and all other data)     //=-michael harootoonyan added user_type to save it as a session
                    $sth = $this->db_connection->prepare("SELECT user_id, user_name, user_email, user_type, first_name, last_name FROM users WHERE user_id = :user_id
                                                      AND user_rememberme_token = :user_rememberme_token AND user_rememberme_token IS NOT NULL");
                    $sth->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                    $sth->bindValue(':user_rememberme_token', $token, PDO::PARAM_STR);
                    $sth->execute();
                    // get result row (as an object)
                    $result_row = $sth->fetchObject();

                    if (isset($result_row->user_id)) {
                        // write user data into PHP SESSION [a file on your server]
                        $_SESSION['user_id'] = $result_row->user_id;
                        $_SESSION['user_name'] = $result_row->user_name;
                        $_SESSION['user_email'] = $result_row->user_email;
                        $_SESSION['user_logged_in'] = 1;
                       
                        //adding new session variable - michael harootoonyan
                        $_SESSION['user_type'] = $result_row->user_type;
                        $_SESSION['first_name'] = $result_row->first_name;
                        $_SESSION['last_name'] = $result_row->last_name;


                        // declare user id, set the login status to true
                        $this->user_id = $result_row->user_id;
                        $this->user_name = $result_row->user_name;
                        $this->user_email = $result_row->user_email;
                        $this->user_is_logged_in = true;

                        //adding declaration for user type -michael harootoonyan
                        $this->user_type = $result_row->user_type;
                        $this->first_name = $result_row->first_name;
                        $this->last_name = $result_row->last_name;

                        // Cookie token usable only once
                        $this->newRememberMeCookie();
                        return true;
                    }
                }
            }
            // A cookie has been used but is not valid... we delete it
            $this->deleteRememberMeCookie();
            $this->errors[] = MESSAGE_COOKIE_INVALID;
        }
        return false;
    }

    /**
     * Logs in with the data provided in $_POST, coming from the login form
     * @param $user_name
     * @param $user_password
     * @param $user_rememberme
     */
    public function loginWithPostData($user_name, $user_password, $user_rememberme)
    {
        if (empty($user_name)) {
            $this->errors[] = MESSAGE_USERNAME_EMPTY;
        } else if (empty($user_password)) {
            $this->errors[] = MESSAGE_PASSWORD_EMPTY;

        // if POST data (from login form) contains non-empty user_name and non-empty user_password
        } else {
            // user can login with his username or his email address.
            // if user has not typed a valid email address, we try to identify him with his user_name
            if (!filter_var($user_name, FILTER_VALIDATE_EMAIL)) {
                // database query, getting all the info of the selected user
                $result_row = $this->getUserData(trim($user_name));
                
            // if user has typed a valid email address, we try to identify him with his user_email
            } else {//if ($this->databaseConnection()) {
                // database query, getting all the info of the selected user
                // $query_user = $this->db_connection->prepare('SELECT * FROM users WHERE user_email = :user_email');
                // $query_user->bindValue(':user_email', trim($user_name), PDO::PARAM_STR);
                // $query_user->execute();
                // // get result row (as an object)
                // $result_row = $query_user->fetchObject();
                // get result row (as an object)

                $result_row = $this->where('user_email', '=', trim($user_name))->get()[0];
            }

            // if this user not exists
            if ($result_row == false) {
                // was MESSAGE_USER_DOES_NOT_EXIST before, but has changed to 'MESSAGE_LOGIN_FAILED'
                // to prevent potential attackers showing if the user exists
                $this->errors[] = MESSAGE_LOGIN_FAILED;
                return false;
            } else if (($result_row->user_failed_logins >= 3) && ($result_row->user_last_failed_login > (time() - 30))) {
                $this->errors[] = MESSAGE_PASSWORD_WRONG_3_TIMES;
                return false;
            // using PHP 5.5's password_verify() function to check if the provided passwords fits to the hash of that user's password
            } else if (! password_verify($user_password, $result_row->user_password_hash)) {
                // increment the failed login counter for that user
                // $sth = $this->db_connection->prepare('UPDATE users '
                //         . 'SET user_failed_logins = user_failed_logins+1, user_last_failed_login = :user_last_failed_login '
                //         . 'WHERE user_name = :user_name OR user_email = :user_name');
                // $sth->execute(array(':user_name' => $user_name, ':user_last_failed_login' => time()));

                //$this->users_failed_logins = 'user_failed_logins+1'; //skeptical this will work, good time to write a store procedure..
                //$this->user_last_failed_login = time();
                //$this->where('user_name', '=', trim($user_name))->save();
                $temp_user_model = $this->where('user_name', '=', trim($user_name))->get()[0];
                $this->user_failed_logins = $temp_user_model->user_failed_logins+1;
                $this->user_last_failed_login = time();
                $this->where('user_name', '=', trim($user_name))->save();

                

                $this->errors[] = MESSAGE_PASSWORD_WRONG;
                return false;
            // has the user activated their account with the verification email
            } else if ($result_row->user_active != 1) {
                $this->errors[] = MESSAGE_ACCOUNT_NOT_ACTIVATED;
                return false;
            } else {
                // write user data into PHP SESSION [a file on your server]
                $_SESSION['user_id'] = $result_row->user_id;
                $_SESSION['user_name'] = $result_row->user_name;
                $_SESSION['user_email'] = $result_row->user_email;
                $_SESSION['user_logged_in'] = 1;
                $_SESSION['user_type'] = $result_row->user_type;
                $_SESSION['first_name'] = $result_row->first_name;
                $_SESSION['last_name'] = $result_row->last_name;

                // declare user id, set the login status to true
                $this->user_id = $result_row->user_id;
                $this->user_name = $result_row->user_name;
                $this->user_email = $result_row->user_email;
                $this->user_is_logged_in = true;
                $this->user_type = $result_row->user_type;
                $this->first_name = $result_row->first_name;
                $this->last_name = $result_row->last_name;

                // reset the failed login counter for that user
                // $sth = $this->db_connection->prepare('UPDATE users '
                //         . 'SET user_failed_logins = 0, user_last_failed_login = NULL '
                //         . 'WHERE user_id = :user_id AND user_failed_logins != 0');
                // $sth->execute(array(':user_id' => $result_row->user_id));
                $this->query('UPDATE users '
                         . 'SET user_failed_logins = 0, user_last_failed_login = NULL '
                         . 'WHERE user_id = :user_id AND user_failed_logins != 0');
                $this->bind(':user_id', $result_row->user_id, PDO::PARAM_INT);
                $this->execute();
                //$this->user_failed_logins = 0;
                //$this->user_last_failed_login = 'null';
               // var_dump($this->user_last_failed_login);
                //$this->where('user_id', '=', $this->user_id)->where('user_failed_logins', '!=', 0)->save();

                // if user has check the "remember me" checkbox, then generate token and write cookie
                if (isset($user_rememberme)) {
                    $this->newRememberMeCookie();
                } else {
                    // Reset remember-me token
                    if (isset($_COOKIE['rememberme'])) {
                        $this->deleteRememberMeCookie();
                    }
                }

                // OPTIONAL: recalculate the user's password hash
                // DELETE this if-block if you like, it only exists to recalculate users's hashes when you provide a cost factor,
                // by default the script will use a cost factor of 10 and never change it.
                // check if the have defined a cost factor in config/hashing.php
                if (defined('HASH_COST_FACTOR')) {
                    // check if the hash needs to be rehashed
                    if (password_needs_rehash($result_row->user_password_hash, PASSWORD_DEFAULT, array('cost' => HASH_COST_FACTOR))) {

                        // calculate new hash with new cost factor
                        $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT, array('cost' => HASH_COST_FACTOR));

                        $this->user_password_hash = $user_password_hash;
                        $this->where('user_id', '=', $user_id)->save();
                        // $query_update = $this->db_connection->prepare('UPDATE users SET user_password_hash = :user_password_hash WHERE user_id = :user_id');
                        // $query_update->bindValue(':user_password_hash', $user_password_hash, PDO::PARAM_STR);
                        // $query_update->bindValue(':user_id', $result_row->user_id, PDO::PARAM_INT);
                        // $query_update->execute();

                        // if ($query_update->rowCount() == 0) {
                        //     // writing new hash was successful. you should now output this to the user ;)
                        // } else {
                        //     // writing new hash was NOT successful. you should now output this to the user ;)
                        // }
                    }
                }
                return true;
            }
        }
        return false;
    }

    /**
     * Create all data needed for remember me cookie connection on client and server side
     */
    public function newRememberMeCookie()
    {
        // if database connection opened
        //if ($this->databaseConnection()) {
            // generate 64 char random string and store it in current user data
            $random_token_string = hash('sha256', mt_rand().'');
            //$sth = $this->db_connection->prepare("UPDATE users SET user_rememberme_token = :user_rememberme_token WHERE user_id = :user_id");
            //$sth->execute(array(':user_rememberme_token' => $random_token_string, ':user_id' => $_SESSION['user_id']));
            $this->user_rememberme_token = $random_token_string;
            $result = $this->where('user_id', '=', $_SESSION['user_id'])->save();
            
            // generate cookie string that consists of userid, randomstring and combined hash of both
            $cookie_string_first_part = $_SESSION['user_id'] . ':' . $random_token_string;
            $cookie_string_hash = hash('sha256', $cookie_string_first_part . COOKIE_SECRET_KEY);
            $cookie_string = $cookie_string_first_part . ':' . $cookie_string_hash;

            
            
            // set cookie
            setcookie('rememberme', $cookie_string, time() + COOKIE_RUNTIME, "/", COOKIE_DOMAIN);
            
        //}
    }

    /**
     * Delete all data needed for remember me cookie connection on client and server side
     */
    public function deleteRememberMeCookie()
    {
        // Reset rememberme token
        $this->query("UPDATE users SET user_rememberme_token = NULL WHERE user_id = :user_id");
        $this->bind(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $this->execute();


        // set the rememberme-cookie to ten years ago (3600sec * 365 days * 10).
        // that's obivously the best practice to kill a cookie via php
        // @see http://stackoverflow.com/a/686166/1114320
        setcookie('rememberme', '', time() - (3600 * 3650), '/', COOKIE_DOMAIN);
    }

    /**
     * Perform the logout, resetting the session
     */
    public function doLogout()
    {
        if (isset($_COOKIE['rememberme'])) {
         $this->deleteRememberMeCookie();
        }


        $_SESSION = array();
        if (session_status() !== PHP_SESSION_NONE)
            session_destroy();
        
        

        $this->user_is_logged_in = false;
        $this->messages[] = MESSAGE_LOGGED_OUT;
        return true;
    }

    /**
     * Simply return the current state of the user's login
     * @return bool user's login status
     */
    public function isUserLoggedIn()
    {
        return $this->user_is_logged_in;
    }

    /**
     * Edit the user's name, provided in the editing form
     */
    public function editUserName($user_name)
    {
        // prevent database flooding
        $user_name = substr(trim($user_name), 0, 64);

        if (!empty($user_name) && $user_name == $_SESSION['user_name']) {
            $this->errors[] = MESSAGE_USERNAME_SAME_LIKE_OLD_ONE;

        // username cannot be empty and must be azAZ09 and 2-64 characters
        // TODO: maybe this pattern should also be implemented in Registration.php (or other way round)
        } elseif (empty($user_name) || !preg_match("/^(?=.{2,64}$)[a-zA-Z][a-zA-Z0-9]*(?: [a-zA-Z0-9]+)*$/", $user_name)) {
            $this->errors[] = MESSAGE_USERNAME_INVALID;

        } else {
            // check if new username already exists
            $result_row = $this->getUserData($user_name);

            if (isset($result_row->user_id)) {
                $this->errors[] = MESSAGE_USERNAME_EXISTS;
            } else {
                // write user's new data into database
                $query_edit_user_name = $this->db_connection->prepare('UPDATE users SET user_name = :user_name WHERE user_id = :user_id');
                $query_edit_user_name->bindValue(':user_name', $user_name, PDO::PARAM_STR);
                $query_edit_user_name->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
                $query_edit_user_name->execute();

                if ($query_edit_user_name->rowCount()) {
                    $_SESSION['user_name'] = $user_name;
                    $this->messages[] = MESSAGE_USERNAME_CHANGED_SUCCESSFULLY . $user_name;
                } else {
                    $this->errors[] = MESSAGE_USERNAME_CHANGE_FAILED;
                }
            }
        }
    }

    /**
     * Edit the user's email, provided in the editing form
     */
    public function editUserEmail($user_email)
    {
        // prevent database flooding
        $user_email = substr(trim($user_email), 0, 64);

        if (!empty($user_email) && $user_email == $_SESSION["user_email"]) {
            $this->errors[] = MESSAGE_EMAIL_SAME_LIKE_OLD_ONE;
        // user mail cannot be empty and must be in email format
        } elseif (empty($user_email) || !filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = MESSAGE_EMAIL_INVALID;

        } else if ($this->databaseConnection()) {
            // check if new email already exists
            $query_user = $this->db_connection->prepare('SELECT * FROM users WHERE user_email = :user_email');
            $query_user->bindValue(':user_email', $user_email, PDO::PARAM_STR);
            $query_user->execute();
            // get result row (as an object)
            $result_row = $query_user->fetchObject();

            // if this email exists
            if (isset($result_row->user_id)) {
                $this->errors[] = MESSAGE_EMAIL_ALREADY_EXISTS;
            } else {
                // write users new data into database
                $query_edit_user_email = $this->db_connection->prepare('UPDATE users SET user_email = :user_email WHERE user_id = :user_id');
                $query_edit_user_email->bindValue(':user_email', $user_email, PDO::PARAM_STR);
                $query_edit_user_email->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
                $query_edit_user_email->execute();

                if ($query_edit_user_email->rowCount()) {
                    $_SESSION['user_email'] = $user_email;
                    $this->messages[] = MESSAGE_EMAIL_CHANGED_SUCCESSFULLY . $user_email;
                } else {
                    $this->errors[] = MESSAGE_EMAIL_CHANGE_FAILED;
                }
            }
        }
    }

    /**
     * Edit the user's password, provided in the editing form
     */
    public function editUserPassword($user_password_old, $user_password_new, $user_password_repeat)
    {
        $error_occured = false;
        if (empty($user_password_new) || empty($user_password_repeat) || empty($user_password_old)) {
            $this->errors[] = MESSAGE_PASSWORD_EMPTY;
            $error_occured = true;
        // is the repeat password identical to password
        } elseif ($user_password_new !== $user_password_repeat) {
            $this->errors[] = MESSAGE_PASSWORD_BAD_CONFIRM;
            $error_occured = true;
        // password need to have a minimum length of 6 characters
        } elseif (strlen($user_password_new) < 6) {
            $this->errors[] = MESSAGE_PASSWORD_TOO_SHORT;
            $error_occured = true;
        } 

        if ($error_occured)
        {
            return false;
        }

        // database query, getting hash of currently logged in user (to check with just provided password)
        $result_row = $this->getUserData($_SESSION['user_name']);

        // if this user exists
        if (isset($result_row->user_password_hash)) {

            // using PHP 5.5's password_verify() function to check if the provided passwords fits to the hash of that user's password
            if (password_verify($user_password_old, $result_row->user_password_hash)) {

                // now it gets a little bit crazy: check if we have a constant HASH_COST_FACTOR defined (in config/hashing.php),
                // if so: put the value into $hash_cost_factor, if not, make $hash_cost_factor = null
                $hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);

                // crypt the user's password with the PHP 5.5's password_hash() function, results in a 60 character hash string
                // the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using PHP 5.3/5.4, by the password hashing
                // compatibility library. the third parameter looks a little bit shitty, but that's how those PHP 5.5 functions
                // want the parameter: as an array with, currently only used with 'cost' => XX.
                $user_password_hash = password_hash($user_password_new, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));

                // write users new hash into database
                $query_update = $this->db_connection->prepare('UPDATE users SET user_password_hash = :user_password_hash WHERE user_id = :user_id');
                $query_update->bindValue(':user_password_hash', $user_password_hash, PDO::PARAM_STR);
                $query_update->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
                $query_update->execute();

                // check if exactly one row was successfully changed:
                if ($query_update->rowCount()) {
                    $this->messages[] = MESSAGE_PASSWORD_CHANGED_SUCCESSFULLY;
                    return true;
                } else {
                    $this->errors[] = MESSAGE_PASSWORD_CHANGE_FAILED;
                }
            } else {
                $this->errors[] = MESSAGE_OLD_PASSWORD_WRONG;
            }
        } else {
            $this->errors[] = MESSAGE_USER_DOES_NOT_EXIST;
        }

        return false;
        
    }

    /**
     * Sets a random token into the database (that will verify the user when he/she comes back via the link
     * in the email) and sends the according email.
     */
    public function setPasswordResetDatabaseTokenAndSendMail($user_name)
    {
        $user_name = trim($user_name);

        if (empty($user_name)) {
            $this->errors[] = MESSAGE_USERNAME_EMPTY;

        } else {
            // generate timestamp (to see when exactly the user (or an attacker) requested the password reset mail)
            // btw this is an integer ;)
            $temporary_timestamp = time();
            // generate random hash for email password reset verification (40 char string)
            $user_password_reset_hash = sha1(uniqid(mt_rand().'', true));
            // database query, getting all the info of the selected user
            $result_row = $this->getUserData($user_name);

            // if this user exists
            if (isset($result_row->user_id)) {

                // database query:
                // $query_update = $this->db_connection->prepare('UPDATE users SET user_password_reset_hash = :user_password_reset_hash,
                //                                                user_password_reset_timestamp = :user_password_reset_timestamp
                //                                                WHERE user_name = :user_name');
                // $query_update->bindValue(':user_password_reset_hash', $user_password_reset_hash, PDO::PARAM_STR);
                // $query_update->bindValue(':user_password_reset_timestamp', $temporary_timestamp, PDO::PARAM_INT);
                // $query_update->bindValue(':user_name', $user_name, PDO::PARAM_STR);
                // $query_update->execute();
                $this->user_password_reset_hash = $user_password_reset_hash;
                $this->user_password_reset_timestamp = $user_password_reset_timestamp;
                $has_updated = $this->where('user_name', '=', $user_name)
                     ->orWhere('user_email', '=', $user_name) // we allow them to enter email in form
                     ->save();

                // check if exactly one row was successfully changed:
                if ($has_updated) {
                    // send a mail to the user, containing a link with that token hash string
                    $this->sendPasswordResetMail($user_name, $result_row->user_email, $user_password_reset_hash);
                    return true;
                } else {
                    $this->errors[] = MESSAGE_DATABASE_ERROR;
                }
            } else {
                $this->errors[] = MESSAGE_USER_DOES_NOT_EXIST;
            }
        }
        // return false (this method only returns true when the database entry has been set successfully)
        return false;
    }

    /**
     * Sends the password-reset-email.
     */
    public function sendPasswordResetMail($user_name, $user_email, $user_password_reset_hash)
    {
        $mail = new PHPMailer;

        // please look into the config/config.php for much more info on how to use this!
        // use SMTP or use mail()
        if (EMAIL_USE_SMTP) {
            // Set mailer to use SMTP
            $mail->isSMTP();
            $mail->SMTPOptions = array(
              'ssl' => array(
                  'verify_peer' => false,
                  'verify_peer_name' => false,
                  'allow_self_signed' => true
              )
            );
            //useful for debugging, shows full SMTP errors
            $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            // Enable SMTP authentication
            $mail->SMTPAuth = EMAIL_SMTP_AUTH;
            // Enable encryption, usually SSL/TLS
            if (defined(EMAIL_SMTP_ENCRYPTION)) {
                $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
            }
            // Specify host server
            $mail->Host = EMAIL_SMTP_HOST;
            $mail->Username = EMAIL_SMTP_USERNAME;
            $mail->Password = EMAIL_SMTP_PASSWORD;
            $mail->Port = EMAIL_SMTP_PORT;
        } else {
            $mail->isMail();
        }

        $mail->From = EMAIL_PASSWORDRESET_FROM;
        $mail->FromName = EMAIL_PASSWORDRESET_FROM_NAME;
        $mail->addAddress($user_email);
        $mail->Subject = EMAIL_PASSWORDRESET_SUBJECT;

        $link    = EMAIL_PASSWORDRESET_URL.'?user_name='.urlencode($user_name).'&verification_code='.urlencode($user_password_reset_hash);
        $mail->Body = EMAIL_PASSWORDRESET_CONTENT . ' ' . $link;

        if(!$mail->send()) {
            $this->errors[] = MESSAGE_PASSWORD_RESET_MAIL_FAILED . $mail->ErrorInfo;
            return false;
        } else {
            $this->messages[] = MESSAGE_PASSWORD_RESET_MAIL_SUCCESSFULLY_SENT;
            return true;
        }
    }

    /**
     * Checks if the verification string in the account verification mail is valid and matches to the user.
     */
    public function checkIfEmailVerificationCodeIsValid($user_name, $verification_code)
    {
        $user_name = trim($user_name);

        if (empty($user_name) || empty($verification_code)) {
            $this->errors[] = MESSAGE_LINK_PARAMETER_EMPTY;
        } else {
            // database query, getting all the info of the selected user
            $result_row = $this->getUserData($user_name);

            // if this user exists and have the same hash in database
            if (isset($result_row->user_id) && $result_row->user_password_reset_hash == $verification_code) {

                $timestamp_one_hour_ago = time() - 3600; // 3600 seconds are 1 hour

                if ($result_row->user_password_reset_timestamp > $timestamp_one_hour_ago) {
                    // set the marker to true, making it possible to show the password reset edit form view
                    $this->password_reset_link_is_valid = true;
                } else {
                    $this->errors[] = MESSAGE_LINK_RESET_HAS_EXPIRED;
                }
            } else {
                $this->errors[] = MESSAGE_USER_DOES_NOT_EXIST;
            }
        }
    }

    /**
     * Checks and writes the new password.
     */
    public function editNewPassword($user_name, $user_password_reset_hash, $user_password_new, $user_password_repeat)
    {
        $error_occured = false;

        $user_name = trim($user_name);

        if (empty($user_name) || empty($user_password_reset_hash) || empty($user_password_new) || empty($user_password_repeat)) 
        {
            $this->errors[] = MESSAGE_PASSWORD_EMPTY;
            $error_occured = true;
        } 
        else if ($user_password_new !== $user_password_repeat) 
        {
            $this->errors[] = MESSAGE_PASSWORD_BAD_CONFIRM;
            $error_occured = true;
        // password need to have a minimum length of 6 characters
        } 
        else if (strlen($user_password_new) < MINIMUM_PASSWORD_LENGTH) 
        {
            $this->errors[] = MESSAGE_PASSWORD_TOO_SHORT;
            $error_occured = true;
        }

        if ($error_occured)
        {
            return false;
        }
        // check if HASH_COST_FACTOR defined (in config/LoginRegistration.php),
        $hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);

        // crypt the user's password with the PHP 5.5's password_hash() function, results in a 60 character hash string
        // the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using PHP 5.3/5.4, by the password hashing
        // compatibility library. the third parameter looks a little crappy, but that's how those PHP 5.5 functions
        // want the parameter: as an array with, currently only used with 'cost' => XX.
        $user_password_hash = password_hash($user_password_new, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));

        // write users new hash into database were working with NULL value
        $this->query('UPDATE users SET user_password_hash = :user_password_hash,
        user_password_reset_hash = NULL, user_password_reset_timestamp = NULL
        WHERE user_name = :user_name AND user_password_reset_hash = :user_password_reset_hash');
    
        $this->bind(':user_password_hash', $user_password_hash, PDO::PARAM_STR);
        $this->bind(':user_password_reset_hash', $user_password_reset_hash, PDO::PARAM_STR);
        $this->bind(':user_name', $user_name, PDO::PARAM_STR);
        $password_changed_sucessfully = $this->execute();

        
        if ($password_changed_sucessfully) {
            $this->password_reset_was_successful = true;
            $this->messages[] = MESSAGE_PASSWORD_CHANGED_SUCCESSFULLY;
            return true;
        } else {
            $this->errors[] = MESSAGE_PASSWORD_CHANGE_FAILED;
        }
        return false;
    }

    /**
     * Gets the success state of the password-reset-link-validation.
     * TODO: should be more like getPasswordResetLinkValidationStatus
     * @return boolean
     */
    public function passwordResetLinkIsValid()
    {
        return $this->password_reset_link_is_valid;
    }

    /**
     * Gets the success state of the password-reset action.
     * TODO: should be more like getPasswordResetSuccessStatus
     * @return boolean
     */
    public function passwordResetWasSuccessful()
    {
        return $this->password_reset_was_successful;
    }

    /**
     * Gets the username
     * @return string username
     */
    public function getUsername()
    {
        return $this->user_name;
    }

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     * Gravatar is the #1 (free) provider for email address based global avatar hosting.
     * The URL (or image) returns always a .jpg file !
     * For deeper info on the different parameter possibilities:
     * @see http://de.gravatar.com/site/implement/images/
     *
     * @param string $email The email address
     * @param string $s Size in pixels, defaults to 50px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @source http://gravatar.com/site/implement/images/php/
     */
    public function getGravatarImageUrl($email, $s = 50, $d = 'mm', $r = 'g', $atts = array() )
    {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r&f=y";

        // the image url (on gravatarr servers), will return in something like
        // http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=80&d=mm&r=g
        // note: the url does NOT have something like .jpg
        $this->user_gravatar_image_url = $url;

        // build img tag around
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val)
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';

        // the image url like above but with an additional <img src .. /> around
        $this->user_gravatar_image_tag = $url;
    }


/*
* sends an email to the provided email address
* @return boolean gives back true if mail has been sent, gives back false if no mail could been sent
*/
public function sendVerificationEmail($user_id, $user_email, $user_activation_hash)
{

    $mail = new PHPMailer;

    // please look into the config/config.php for much more info on how to use this!
    // use SMTP or use mail()
    if (EMAIL_USE_SMTP) 
    {
      // Set mailer to use SMTP
      $mail->isSMTP();
      $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
      );
      //useful for debugging, shows full SMTP errors
      //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
      // Enable SMTP authentication
      $mail->SMTPAuth = EMAIL_SMTP_AUTH;
      // Enable encryption, usually SSL/TLS
      if (defined(EMAIL_SMTP_ENCRYPTION)) 
      {
        $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
      }
      // Specify host server
      $mail->Host = EMAIL_SMTP_HOST;
      $mail->Username = EMAIL_SMTP_USERNAME;
      $mail->Password = EMAIL_SMTP_PASSWORD;
      $mail->Port = EMAIL_SMTP_PORT;
    } 
    else 
    {
      $mail->isMail();
    }

    $mail->From = EMAIL_VERIFICATION_FROM;
    $mail->FromName = EMAIL_VERIFICATION_FROM_NAME;
    $mail->addAddress($user_email);
    $mail->Subject = EMAIL_VERIFICATION_SUBJECT;

    $link = EMAIL_VERIFICATION_URL.'?id='.urlencode($user_id).'&verification_code='.urlencode($user_activation_hash);

    // the link to your register.php, please set this value in config/email_verification.php
    $mail->Body = EMAIL_VERIFICATION_CONTENT.' '.$link;

    if(!$mail->send()) 
    {
      $this->errors[] = MESSAGE_VERIFICATION_MAIL_NOT_SENT . $mail->ErrorInfo;
      return false;
    } 
    else 
    {
      return true;
    }
}

 /**
  * checks the id/verification code combination and set the user's activation status to true (=1) in the database
  */
  public function verifyNewUser($user_id, $user_activation_hash)
  {
    if ($this->databaseConnection()) 
    { // if database connection opened
      // try to update user with specified information
      $query_update_user = $this->db_connection->prepare('UPDATE users SET user_active = 1, user_activation_hash = NULL WHERE user_id = :user_id AND user_activation_hash = :user_activation_hash');
      $query_update_user->bindValue(':user_id', intval(trim($user_id)), PDO::PARAM_INT);
      $query_update_user->bindValue(':user_activation_hash', $user_activation_hash, PDO::PARAM_STR);
      $query_update_user->execute();

      if ($query_update_user->rowCount() > 0) 
      {
        $this->verification_successful = true;
        $this->messages[] = MESSAGE_REGISTRATION_ACTIVATION_SUCCESSFUL;
        return true;
      } 
      else 
      {
        $this->errors[] = MESSAGE_REGISTRATION_ACTIVATION_NOT_SUCCESSFUL;
        return false;
      }
    }
  }
}


?>
<?php

    /**
    * The User page controller
    */
    class UserController
    {
        private $model;
        private $view;

        function __construct()
        {
            $this->model = new UserModel();
            $this->view = new UserView();

        }

        /**
         * Public methods
         */
    
        public function displayLogin()
        {
          if(isset($_SESSION['user_name']))
          {
            header('Location: ./dashboard');
          }
          else
          {
            $this->view->login(); 
          }
        }

        public function displayDashboard()
        {
          if(isset($_SESSION['user_name']))
          {
            $this->view->dashboard();
          }else{
            header('Location: ./login');

          }
        }

        public function displayRegistration()
        {
          $this->view->registration();
        }

        public function login($username,$password,$rememberme)
        {

            if(!isset($_SESSION['user_name']))
            {
                if(!$this->model->loginWithPostData($username, $password, $rememberme))
                {
                  $_SESSION["login_error"] = $this->model->errors;
                  header('Location: ./login');
                }else{
                  header('Location: ./dashboard');
                }
            }
            
        }



        public function logout()
        {
            header('Location: ./login');
            $this->model->doLogout();
        }

        public function registerUser($email,$first,$last,$username,$passnew,$passrepeat,$usertype,$captcha)
        {

          
            $user_is_registered = $this->model->registerNewUser($email, $usertype, $first, $last, 
            $username, $passnew, $passrepeat, $captcha);
            if ($user_is_registered) {
              $_SESSION["registration_success"] = $this->model->messages;
              header('Location: ./login');
            } else {
              $_SESSION["registration_error"] = $this->model->errors;
              header('Location: ./register');
            }
        }

        public function userEmailActivation($user_id, $verification_code)
        {
          // user/emailVerification route name
          $user_has_been_verified = $this->model->verifyNewUser($user_id, $verification_code);
          if ($user_has_been_verified)
          {
            $_SESSION["registration_success"] = $this->model->messages;
            header('Location: ./login');
          }
          else
          {
            $_SESSION["registration_error"] = $this->model->errors;
            header('Location: ./register');
          }
          
          
        }



        /*

        public function getUsers()
        {
            return $this->modelObj->getAllUsers();
        }

        public function getUser($param)
        {
            $id = $param[0];
            return $this->modelObj->getUserByID($id);
        }

        

        
      
 
        public function routing()
        {
          // no need for this its in index.php session_start();
          // if (isset($_POST["register"])) 
          // {
          //   $this->modelObj->registerNewUser($_POST['user_type'], $_POST['first_name'], $_POST['last_name'], 
          //    $_POST['user_name'], $_POST['user_password_new'], $_POST['user_password_repeat'], $_POST["captcha"]);
          // } 
          // else 
          if (isset($_GET["id"]) && isset($_GET["verification_code"])) 
          {
            $this->model->verifyNewUser($_GET["id"], $_GET["verification_code"]);
          }
          else if (isset($_GET["logout"])) 
          {
            $this->model->doLogout();
          } 
          else if (!empty($_SESSION['user_name']) && ($_SESSION['user_logged_in'] == 1)) 
          { // if user has an active session on the server
            $this->model->loginWithSessionData();
      
            // checking for form submit from editing screen
            if (isset($_POST["user_edit_submit_name"])) 
            { // user try to change his username
              // function below uses use $_SESSION['user_id'] et $_SESSION['user_email']
              $this->model->editUserName($_POST['user_name']);
            } 
            elseif (isset($_POST["user_edit_submit_email"])) 
            { // user try to change his email
              // function below uses use $_SESSION['user_id'] et $_SESSION['user_email']
              $this->model->editUserEmail($_POST['user_email']);
            } 
            elseif (isset($_POST["user_edit_submit_password"])) 
            { // user try to change his password
              // function below uses $_SESSION['user_name'] and $_SESSION['user_id']
              $this->model->editUserPassword($_POST['user_password_old'], $_POST['user_password_new'], $_POST['user_password_repeat']);
            }
          
          }
          else if (isset($_COOKIE['rememberme'])) 
          { // login with cookie
            $this->model->loginWithCookieData();
          } 
          else if (isset($_POST["login"])) 
          { // if user just submitted a login form
            if (!isset($_POST['user_rememberme'])) 
            {
              $_POST['user_rememberme'] = null;
            }
            $this->modelObj->loginWithPostData($_POST['user_name'], $_POST['user_password'], $_POST['user_rememberme']);
          }
          else if (isset($_POST["request_password_reset"]) && isset($_POST['user_name'])) 
          { // checking if user requested a password reset mail
            $this->model->setPasswordResetDatabaseTokenAndSendMail($_POST['user_name']);
          } 
          else if (isset($_GET["user_name"]) && isset($_GET["verification_code"])) 
          {
            $this->model->checkIfEmailVerificationCodeIsValid($_GET["user_name"], $_GET["verification_code"]);
          } 
          else if (isset($_POST["submit_new_password"])) 
          {
            $this->model->editNewPassword($_POST['user_name'], $_POST['user_password_reset_hash'], $_POST['user_password_new'], $_POST['user_password_repeat']);
          }
          // get gravatar profile picture if user is logged in
          else if ($this->model->isUserLoggedIn() == true) 
          {
            //$this->modelObj->getGravatarImageUrl($this->modelObj->user_email);
            return true;
            
          }
        }
        /*
        public function verifyUser($user_id, $user_activation_hash)
        {
          return $this->modelObj->verifyNewUser($user_id, $user_activation_hash);
        }

      */
}

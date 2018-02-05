<?php

    /**
    * The User page controller
    */
    class UserController
    {
        private $modelObj;

        function __construct( $model )
        {
            $this->modelObj = $model;

        }

        /**
         * Public methods
         */
        public function getUsers()
        {
            return $this->modelObj->getAllUsers();
        }

        public function getUser($param)
        {
            $id = $param[0];
            return $this->modelObj->getUserByID($id);
        }

        public function login($user_name, $password, $remember_me)
        {
            if(!isset($_SESSION['user_name']))
                $this->modelObj->loginWithPostData($user_name, $password, $remember_me);
            else
                $this->routing();

        }

        public function routing()
        {
          // no need for this its in index.php session_start();
          if (isset($_POST["register"])) 
          {
            $this->modelObj->registerNewUser($_POST['user_type'], $_POST['first_name'], $_POST['last_name'], 
             $_POST['user_name'], $_POST['user_password_new'], $_POST['user_password_repeat'], $_POST["captcha"]);
          } 
          else if (isset($_GET["id"]) && isset($_GET["verification_code"])) 
          {
            $this->modelObj->verifyNewUser($_GET["id"], $_GET["verification_code"]);
          }
          else if (isset($_GET["logout"])) 
          {
            $this->modelObj->doLogout();
          } 
          else if (!empty($_SESSION['user_name']) && ($_SESSION['user_logged_in'] == 1)) 
          { // if user has an active session on the server
            $this->modelObj->loginWithSessionData();
      
            // checking for form submit from editing screen
            if (isset($_POST["user_edit_submit_name"])) 
            { // user try to change his username
              // function below uses use $_SESSION['user_id'] et $_SESSION['user_email']
              $this->modelObj->editUserName($_POST['user_name']);
            } 
            elseif (isset($_POST["user_edit_submit_email"])) 
            { // user try to change his email
              // function below uses use $_SESSION['user_id'] et $_SESSION['user_email']
              $this->modelObj->editUserEmail($_POST['user_email']);
            } 
            elseif (isset($_POST["user_edit_submit_password"])) 
            { // user try to change his password
              // function below uses $_SESSION['user_name'] and $_SESSION['user_id']
              $this->modelObj->editUserPassword($_POST['user_password_old'], $_POST['user_password_new'], $_POST['user_password_repeat']);
            }
          
          }
          else if (isset($_COOKIE['rememberme'])) 
          { // login with cookie
            $this->modelObj->loginWithCookieData();
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
            $this->modelObj->setPasswordResetDatabaseTokenAndSendMail($_POST['user_name']);
          } 
          else if (isset($_GET["user_name"]) && isset($_GET["verification_code"])) 
          {
            $this->modelObj->checkIfEmailVerificationCodeIsValid($_GET["user_name"], $_GET["verification_code"]);
          } 
          else if (isset($_POST["submit_new_password"])) 
          {
            $this->modelObj->editNewPassword($_POST['user_name'], $_POST['user_password_reset_hash'], $_POST['user_password_new'], $_POST['user_password_repeat']);
          }
          // get gravatar profile picture if user is logged in
          else if ($this->modelObj->isUserLoggedIn() == true) 
          {
            //$this->modelObj->getGravatarImageUrl($this->modelObj->user_email);
            return true;
            
          }
        }


     }
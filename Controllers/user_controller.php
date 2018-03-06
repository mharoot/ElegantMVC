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

  public function displayLogin()
  {
    if(isset($_SESSION['user_name']))
    {
      header('Location: ./dashboard');
    }
    else
    {  // check if a cookie has been set even though the session is expired
      if ($this->model->loginWithCookieData())
      {
         header('Location: ./dashboard');
      } 
      else $this->view->login(); 
    }
  }


  public function displayDashboard()
  {
    if(isset($_SESSION['user_name']))
    {
      $this->view->dashboard();
    }
    else
    {
      header('Location: ./login');
    }
  }

  public function displayEditPasswordForm($user_name = NULL, $user_password_reset_hash = NULL)
  {
    if (!isset($_SESSION['user_name']) && $user_name == NULL && $user_password_reset_hash == NULL)
      header('Location: ./login');
    else
      $this->view->editPasswordForm();
  }
  
  public function displayEditUserEmailForm()
  {
    if (isset($_SESSION['user_name']))
      $this->view->editUserEmailForm();
    else
      header('Location: ./login');
  }

  public function displayEditUserNameForm()
  {
    if (isset($_SESSION['user_name']))
      $this->view->editUserNameForm();
    else
      header('Location: ./login');
  }

  public function displayEditUserPasswordForm()
  {
    if (isset($_SESSION['user_name']))
      $this->view->editUserPasswordForm();
    else
      header('Location: ./login');
  }
  
  public function displayForgotPasswordForm()
  {
    if(isset($_SESSION['user_name']))
    {
      $this->view->dashboard();
    }
    else
    {
      $this->view->forgotPasswordForm();
    }
  }

  public function displayRegistration()
  {
    $this->view->registration();
  }

  // bad routing architecture discovered.  forms are read top to bottom therefore params are influenced by order of input inside forms html
  public function editPassword($user_password_new, $user_password_repeat, $user_name, $verification_code)
  {
    $user_changed_password_sucessfully = $this->model->editNewPassword($user_name, $verification_code, $user_password_new, $user_password_repeat);

    if ($user_changed_password_sucessfully)
    {
      $_SESSION["registration_success"] = $this->model->messages;
      header('Location: ./login');
    }
    else
    {
      $_SESSION["login_error"] = $this->model->errors;
      header('Location: ./login');
    }

  }


  /**
   * While user is logged in, they can edit their email.
   * @return void
   */
  public function editUserEmail($user_email)
  {
    $email_edited = $this->model->editUserEmail($user_email);
    if ($email_edited)
    {
      $_SESSION["registration_success"] = $this->model->messages;
      header('Location: ./login');
    }
    else
    {
      $_SESSION["login_error"] = $this->model->errors;
      header('Location: ./login');
    }
  }


  /**
   * While user is logged in, they can edit their username.
   * @return void
   */
  public function editUserName($user_name)
  {
    $user_name_edited = $this->model->editUserName($user_name);
    if ($user_name_edited)
    {
      $_SESSION["registration_success"] = $this->model->messages;
      header('Location: ./login');
    }
    else
    {
      $_SESSION["login_error"] = $this->model->errors;
      header('Location: ./login');
    }
  }


  /**
   * While user is logged in, they can edit the password.
   * @return void
   */
  public function editUserPassword($user_password_old, $user_password_new, $user_password_repeat)
  {
    $password_edited = $this->model->editUserPassword($user_password_old, $user_password_new, $user_password_repeat);
    if ($password_edited)
    {
      $_SESSION["success_message"] = $this->model->messages;
      header('Location: ./edit-user-password-form');
    }
    else
    {
      $_SESSION["error_message"] = $this->model->errors;
      header('Location: ./edit-user-password-form');
    }
  }




  public function login($username,$password,$rememberme)
  {
    if(!isset($_SESSION['user_name']))
    {
        if(!$this->model->loginWithPostData($username, $password, $rememberme))
        {
          $_SESSION["login_error"] = $this->model->errors;
          header('Location: ./login');
        }
        else
        {
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
    if ($user_is_registered) 
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

  public function userForgotPasswordEmailReset($user_name)
  {
    $user_has_been_emailed = $this->model->setPasswordResetDatabaseTokenAndSendMail($user_name);

    if ($user_has_been_emailed) // their password reset token
    {
      $_SESSION["registration_success"] = $this->model->messages;
    }
    else
    {
      $_SESSION["registration_error"] = $this->model->errors;
    }
    header('Location: ./login');
  }

}

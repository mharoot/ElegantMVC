<?php

/**
* The User page view
*/
class UserView
{
  public function dashboard($orders)
  {
    require_once 'pages/templates/header.php';    
    require_once 'pages/user/dashboard.php';
    require_once 'pages/templates/footer.php';
  }

  public function editPasswordForm()
  {
    require_once 'pages/templates/header.php';    require_once 'pages/user/edit-password-form.php';
    require_once 'pages/templates/footer.php';
  }

  // while user logged in edit password form
  public function editUserPasswordForm()
  {
    require_once 'pages/templates/header.php';    require_once 'pages/user/edit-user-password-form.php';
    require_once 'pages/templates/footer.php';
  }

  public function editUserEmailForm()
  {
    require_once 'pages/templates/header.php';    require_once 'pages/user/edit-user-email-form.php';
    require_once 'pages/templates/footer.php';
  }

  public function editUserNameForm()
  {
    require_once 'pages/templates/header.php';    require_once 'pages/user/edit-user-name-form.php';
    require_once 'pages/templates/footer.php';
  }

  public function forgotPasswordForm()
  {
    require_once 'pages/templates/header.php';    require_once 'pages/user/forgot-password-form.php';
    require_once 'pages/templates/footer.php';
  }

  public function login()
  {
    if(!isset($_SESSION['user_name']))
    {
      require_once 'pages/templates/header.php';    require_once 'pages/user/login.php';
    }
    require_once 'pages/templates/footer.php';
  }

  public function registration()
  {
    require_once 'pages/templates/header.php';    require_once 'pages/user/register.php';
    require_once 'pages/templates/footer.php';
  }
}

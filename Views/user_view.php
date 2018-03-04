<?php

/**
* The User page view
*/
class UserView
{
  public function dashboard()
  {
    $_SESSION['content'] .= require_once 'pages/user/dashboard.php';
    require_once 'layout.html';
  }

  public function editPasswordForm()
  {
    $_SESSION['content'] .= require_once 'pages/user/edit-password-form.php';
    require_once 'layout.html';
  }

  public function forgotPasswordForm()
  {
    $_SESSION['content'] .= require_once 'pages/user/forgot-password-form.php';
    require_once 'layout.html';
  }

  public function login()
  {
    if(!isset($_SESSION['user_name']))
    {
      $_SESSION['content'] .= require_once 'pages/user/login.php';
    }
    require_once 'layout.html';
  }

  public function registration()
  {
    $_SESSION['content'] .= require_once 'pages/user/register.php';
    require_once 'layout.html';
  }
}

<?php

/**
* The User page view
*/
class UserView
{

  private $modelObj;
  private $controller;

  function __construct($controller, $model)
  {
      $this->controller = $controller;
      $this->modelObj = $model;
  }

  public function all()
  {
      $users = $this->controller->getUsers();
      include "templates/header.php";  
      include "pages/user/get.php"; // get.php is set up for reuse in all view as well.
      include "templates/footer.php";
  }

  public function emailVerification()
  {
    include "templates/header.php";  
    $message = "FAILED TO ACTIVATE ACCOUNT!";
    if (isset($_GET['id']) && isset($_GET['verification_code']))
    {
      if ($this->controller->verifyUser($_GET['id'], $_GET['verification_code']))
      {
        $message = "REGISTRATION ACTIVATION SUCCESSFUL!";
      }
    }
    include "pages/user/email-verification.php";
    include "templates/footer.php";
  }

  public function get($param)
  {
    $id = $param[0];
    $users = $this->controller->getUser($id);
    include "templates/header.php";  
    include "pages/user/get.php";
    include "templates/footer.php";
  }

  public function login()
  {
    include "templates/header.php";  
    include "pages/user/login-form.php";
    include "templates/footer.php";
  }

  public function logout()
  {
      $this->controller->logout();
      header('Location: http://localhost/github/ElegantMVC');
  }

  public function register()
  {
    include "templates/header.php";  
    include "pages/user/register-form.php";

    if(isset($_POST['register']))
    {
      if (isset($_POST['captcha']) && $_POST["captcha"] == $_SESSION['captcha']) 
      { 
        //echo "</br>correct captcha=".$_POST['captcha']."</br>";
      } 
      else if( isset($_POST['captcha']) && $_POST["captcha"] != $_SESSION['captcha'] ) 
      { 
        echo "</br>WRONG captcha=".$_POST['captcha']." vs ".$_SESSION['captcha']."</br>";  
      }
      if ($this->controller->registerUser()) // uses $_POST, no need to pass parameters
      {
        echo "</br> You have successfull registered!  Please check your email to verify your account activation.";
      }
      else 
        echo "Failed to register";
    }
    
    include "templates/footer.php";
    
  }
}
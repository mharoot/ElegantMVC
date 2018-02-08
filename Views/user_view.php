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

    if (isset($_POST['captcha']) && $_POST["captcha"] == $_SESSION['captcha']) 
    { 
      echo "</br>correct captcha=".$_POST['captcha']."</br>";
    } 
    else if( isset($_POST['captcha']) && $_POST["captcha"] != $_SESSION['captcha'] ) 
    { 
      echo "</br>WRONG captcha=".$_POST['captcha']." vs ".$_SESSION['captcha']."</br>";  
    }
    include "templates/footer.php";
    
  }
}
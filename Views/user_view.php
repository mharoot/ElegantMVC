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
      include "templates/header.php"; // just including this to use the $base_url var
      header("Location: $base_url");
  }

  public function register()
  {
    include "templates/header.php";  
    

    if(isset($_POST['register']))
    {
      $this->modelObj = $this->controller->registerUser();
      if (isset($this->modelObj->messages[0]) ) // uses $_POST, no need to pass parameters
      {
        $html_output = "";
        foreach($this->modelObj->messages as $message) {
          $html_output.= "<li>$message</li>";
        }
        $html_output.="</ul></p>";
        echo $html_output;
      }
      else if(isset($this->modelObj->errors[0]))
      {
        $html_output = "<p>Failed to register!</p><p>Reason(s):<ul>";
        foreach($this->modelObj->errors as $error) {
          $html_output.= "<li>$error</li>";
        }
        $html_output.="</ul></p>";
        echo $html_output;
      }
    }
    else
    {
      include "pages/user/register-form.php";
    }
    
    include "templates/footer.php";
    
  }
}
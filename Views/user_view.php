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
    session_start();
    include "templates/header.php";  
    include "pages/user/login-form.php";
    include "templates/footer.php";
  }

  public function logout()
  {
      session_start();
      $this->controller->logout();
      header('Location: http://localhost/github/ElegantMVC');
  }
}
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

      print "Users - ";
  }



  public function all()
  {
      print "All";
      $users = $this->controller->getUsers();
      echo '<ul>';
      foreach(  $users as $user)
      {
          echo "<li>
                  <ul>
                      <li>user id: $user->user_id</li>
                      <li>first name: $user->first_name </li>
                      <li>last name: $user->last_name</li>
                      <li>user name: $user->user_name</li>
                  </ul>
                </li>";
      }
      echo '</ul>';
  }

  public function get($param)
  {
    $id = $param[0];
    print "Get id: ".$id;
    $users = $this->controller->getUser($id);
    echo '<ul>';
    foreach(  $users as $user)
    {
        echo "<li>
                <ul>
                    <li>user id: $user->user_id</li>
                    <li>first name: $user->first_name </li>
                    <li>last name: $user->last_name</li>
                    <li>user name: $user->user_name</li>
                </ul>
              </li>";
    }
    echo '</ul>';
  }

  public function login()
  {
      session_start();
      if (isset($_POST['user_name']) && isset($_POST['password']))
      {
          echo "</br>Given username: ".$_POST['user_name'].", password: ".$_POST['password'];
          $remember_me = true;
          $this->controller->login($_POST['user_name'], $_POST['password'], $remember_me);
          echo "<br></br>SESSION username: ".$_SESSION['user_name'];
      }
      else if (isset($_SESSION['user_name']))
      {
          print "Your logged in as: ".$_SESSION['user_name'];

      }
      else
      {
          print "Login";
    ?>
          <form method="POST">
            <label for="user_name">Username:</label>
            <input name="user_name"></input>
            </br>
            <label for="password">Password:</label>
            <input name="password" type="password" ></input>
            <input type="submit"></input>
          </form>
    <?php
      }
  }

  public function logout()
  {
      session_start();
      $this->controller->logout();
      header('Location: http://localhost/github/ElegantMVC');
  }
}
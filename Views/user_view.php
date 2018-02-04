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
      
      if (isset($_POST['user_name']))
      {
          echo "</br>given: ".$_POST['user_name'];
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
          </form>
    <?php
      }
  }
}
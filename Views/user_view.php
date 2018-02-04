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

  public function get($id)
  {
    print "Get id: ".$id[0];
    $users = $this->controller->getUser($id[0]);
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
}
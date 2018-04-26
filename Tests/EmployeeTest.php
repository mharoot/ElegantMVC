<?php

// in command line run: 
// phpunit Tests/EmployeeTest.php --testdox
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include_once('Elegant/Model.php');
include_once('Models/employee_model.php');
include_once('Models/user_model.php');

class EmployeeTest extends TestCase
{

  public function test_getCustomerOrders()
  {
    $employee = new EmployeeModel();
    $_SESSION['user_id'] = 126; // Nancy Davolios employee 1
    $res = $employee->getCustomerOrders();
    //var_dump($res);
    $GotIt = sizeof($res) > 0;
    $this->assertTrue($GotIt);
      
  }

  public function test_getCustomerOrdersByStatus()
  {
    $employee = new EmployeeModel();
    $_SESSION['user_id'] = 126; // Nancy Davolios employee 1
    $unshipped = 0;
    $res = $employee->getCustomerOrdersByStatus($unshipped);
    //var_dump($res);
    $GotIt = sizeof($res) > 0;
    $this->assertTrue($GotIt);
      
  }

  // public function test_all() 
  // {
  //   $EmployeeModel = new EmployeeModel();
  //   $Employees = $EmployeeModel->all();
  //   $we_have_all_Employees = sizeof($Employees) > 0;
  //   $this->assertTrue( $we_have_all_Employees );
  // }
/*
  public function test_migrate_employee_data_to_users_table()
  {
    $UserModel = new UserModel();
    $EmployeeModel = new EmployeeModel();
    $Employees = $EmployeeModel->all();
    $i = 121; //avoiding duplicate usernames
    foreach ($Employees as $Employee)
    {
      $UserModel->first_name = $Employee->FirstName;
      $UserModel->last_name = $Employee->LastName;
      $UserModel->user_name  = $UserModel->first_name . $UserModel->last_name . $i; // fake username
      $UserModel->user_password_hash = '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi';// translates to password
      $UserModel->user_email = $UserModel->first_name . $UserModel->last_name .'@gmail.com'; //fake email
      $UserModel->user_active = 1;
      $UserModel->user_failed_logins = 0;
      $UserModel->user_registration_datetime = '2018-02-04 13:26:03';
      $UserModel->user_registration_ip = '::1';
      $UserModel->user_type = 3; // Employees are type 3.

      // inserting into users table
      $UserModel->save();

      // now update Employee with the last inserted users id
      $EmployeeModel->UserID = $UserModel->lastInsertId();
      $EmployeeModel->where('EmployeeID', '=', $Employee->EmployeeID)->save();

      $i++; // user_name may be duplicated since the first and last name may be similar.
    }

    $this->assertTrue( true );


  }

  */
}
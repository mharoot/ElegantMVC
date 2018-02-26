<?php
// in command line run: 
// phpunit Tests/SupplierTest.php --testdox
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include_once('Elegant/Model.php');
include_once('Models/supplier_model.php');
include_once('Models/user_model.php');

class SupplierTest extends TestCase
{
  public function test_all() 
  {
    $SupplierModel = new SupplierModel();
    $suppliers = $SupplierModel->all();
    $we_have_all_suppliers = sizeof($suppliers) > 0;
    $this->assertTrue( $we_have_all_suppliers );
  }
/*
  public function test_migrate_supplier_data_to_users_table()
  {
    $UserModel = new UserModel();
    $SupplierModel = new SupplierModel();
    $Suppliers = $SupplierModel->all();
    $i = 92; // entered 91 User-Customers trying to avoid duplicate user names by starting at 92
    foreach ($Suppliers as $Supplier)
    {
      $full_name_array = explode ( ' ' , $Supplier->ContactName);

      $UserModel->first_name = $full_name_array[0];

      $n = sizeof($full_name_array);
      if ($n == 2)
      { // standard first and last name
        $UserModel->last_name = $full_name_array[1];
      }
      else if ($n > 2)
      { // this includes middle names
        $UserModel->last_name = $full_name_array[$n - 1];
      }

      $UserModel->user_name  = $UserModel->first_name . $UserModel->last_name . $i; // fake username
      $i++; // user_name may be duplicated since the first and last name may be similar.

      $UserModel->user_password_hash = '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi';// translates to password
      $UserModel->user_email = $UserModel->first_name . $UserModel->last_name .'@gmail.com'; //fake email

      $UserModel->user_active = 1;
      $UserModel->user_failed_logins = 0;
      $UserModel->user_registration_datetime = '2018-02-04 13:26:03';
      $UserModel->user_registration_ip = '::1';
      $UserModel->user_type = 4; // suppliers are type 4.

      // inserting into users table
      $UserModel->save();

      // now update supplier with the last inserted users id
      $SupplierModel->UserID = $UserModel->lastInsertId();
      $SupplierModel->where('SupplierID', '=', $Supplier->SupplierID)->save();
    }

    $this->assertTrue( true );
    */


  }
}
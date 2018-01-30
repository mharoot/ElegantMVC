<?php
// in command line run: 
// phpunit Tests/CustomerTest.php --testdox
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include_once('Elegant/Model.php');
include_once('Models/customer_model.php');
class CustomerTest extends TestCase
{
  public function test_all() 
  {
    $CustomerModel = new CustomerModel();
    $customers = $CustomerModel->all();
    $we_have_all_customers = sizeof($customers) > 0;
    $this->assertTrue( $we_have_all_customers );
  }
}
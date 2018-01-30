<?php
// in command line run: 
// phpunit Tests/SupplierTest.php --testdox
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include_once('Elegant/Model.php');
include_once('Models/supplier_model.php');
class SupplierTest extends TestCase
{
  public function test_all() 
  {
    $SupplierModel = new SupplierModel();
    $suppliers = $SupplierModel->all();
    $we_have_all_suppliers = sizeof($suppliers) > 0;
    $this->assertTrue( $we_have_all_suppliers );
  }
}
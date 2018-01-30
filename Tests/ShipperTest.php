<?php
// in command line run: 
// phpunit Tests/ShipperTest.php --testdox
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include_once('Elegant/Model.php');
include_once('Models/shipper_model.php');
class ShipperTest extends TestCase
{
  public function test_all() 
  {
    $ShipperModel = new ShipperModel();
    $shippers = $ShipperModel->all();
    $we_have_all_shippers = sizeof($shippers) > 0;
    $this->assertTrue( $we_have_all_shippers );
  }
}
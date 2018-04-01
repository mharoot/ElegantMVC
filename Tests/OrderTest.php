<?php
// in command line run: 
// phpunit Tests/OrderTest.php --testdox
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include_once('Elegant/Model.php');
include_once('Models/order_model.php');
include_once('Models/product_model.php');
include_once('Models/supplier_model.php');
// include_once('Models/user_model.php');
class OrderTest extends TestCase
{

  public function test_one_to_many_order_and_order_details_get() 
  {
      $order_model = new OrderModel();
      $orderDetails = $order_model->oneToMany('orderdetails', 'OrderID', 'OrderID')
                                  ->where('orderdetails.OrderID', '=', 10248)
                                  ->get();

      $product_model = new ProductModel();
      foreach($orderDetails as $od) {
          $productName =  $product_model->where('ProductID', '=', $od->ProductID)
                                        ->single(['ProductName']);
      }
      $this->assertTrue(  $orderDetails != null  );

  }


  public function test_Adding_Additional_Properties_To_Data_Collection() 
  {
      $order_model = new OrderModel();
      $orderDetails = $order_model->oneToMany('orderdetails', 'OrderID', 'OrderID')
                                  ->where('orderdetails.OrderID', '=', 10248)
                                  ->get();

      // Adding Additional Properties To $orderDetails data collection
      $product_model = new ProductModel();
      $supplier_model = new SupplierModel();
      foreach($orderDetails as $od) {
        $pd = $product_model->oneToOne('categories', 'CategoryID', 'CategoryID')
                            ->where('ProductID', '=', $od->ProductID)
                            ->single(['CategoryName', 'ProductName', 'SupplierID', 'Unit', 'Price']);
   
        $od->CategoryName = $pd->CategoryName;
        $od->ProductName  = $pd->ProductName;
        $od->Unit         = $pd->Unit;
        $od->Price        = $pd->Price;
        $od->SupplierName = $supplier_model->where('SupplierID', '=', $pd->SupplierID)
                                           ->single()
                                           ->SupplierName;
      }

      foreach($orderDetails as $od) {
        $this->assertTrue(  $od->CategoryName != null  );
        $this->assertTrue(  $od->ProductName  != null  );
        $this->assertTrue(  $od->Unit         != null  );
        $this->assertTrue(  $od->Price        != null  );
        $this->assertTrue(  $od->SupplierName != null  );
      }

  }

  public function test_order_model_getOrderyById()
  {
    $OrderModel = new OrderModel();
    $orderDetails = $OrderModel->getOrderById(10248);
    
    var_dump($orderDetails);
    $this->assertTrue ($orderDetails != null);

  }



}
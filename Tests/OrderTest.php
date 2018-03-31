<?php
// in command line run: 
// phpunit Tests/OrderTest.php --testdox
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include_once('Elegant/Model.php');
include_once('Models/order_model.php');
// include_once('Models/user_model.php');
class OrderTest extends TestCase
{

    public function test_one_to_many_order_and_order_details_get() 
    {
        $model = new OrderModel();
        $orderDetails = $model->oneToMany('orderdetails', 'OrderID', 'OrderID')
                              ->where('orderdetails.OrderID', '=', 10248)
                              ->get(['ProductID']);
        
        var_dump($orderDetails[0]);
        $this->assertTrue(  $orderDetails != null  );

    }
}
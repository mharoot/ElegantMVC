<?php

/**
* The Employees page view
*/
class EmployeeView
{

  public function customerOrders($orders)
  {
    require_once 'pages/templates/header.php';
    require_once 'pages/employee/customer-orders.php';
    require_once 'pages/templates/footer.php';
  }

  public function displayEmployeeInformation($employee_info)
  {
    require_once 'pages/templates/header.php';
    require_once 'pages/employee/review-employee-information.php';
    require_once 'pages/templates/footer.php';
  }

  public function reviewEmployeeInformation($employee_info)
  {
    require_once 'pages/templates/header.php';
    require_once 'pages/employee/review-employee-information.php';
    require_once 'pages/templates/footer.php'; 
  }

  public function shipOrderForm($shippers, $OrderID)
  {
    require_once 'pages/templates/header.php';
    require_once 'pages/employee/ship-order-form.php';
    require_once 'pages/templates/footer.php';
  }
    
}
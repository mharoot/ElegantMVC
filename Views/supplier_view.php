<?php

/**
* The Supplier page view
*/
class SupplierView
{

  private $modelObj;

  private $controller;


  function __construct($controller, $model)
  {
    $this->controller = $controller;

    $this->modelObj = $model;

    print "Suppliers - ";
  }

  /**
   * Action Methods
   */
  public function suppliers()
  {
    print "suppliers";
    $suppliers = $this->controller->getSuppliers();

    echo '<ul>';
    foreach(  $suppliers as $supplier)
    {
          echo 
          "<li>
            <ul>
            <li>SupplierID: $supplier->SupplierID</li>
            <li>SupplierName: $supplier->SupplierName </li>  
            <li>ContactName: $supplier->ContactName </li>
            <li>Address: $supplier->Address </li>
            <li>City: $supplier->City </li>
            <li>PostalCode: $supplier->PostalCode </li>
            <li>Country: $supplier->Country </li>
            <li>Phone: $supplier->Phone </li>
            </ul>
          </li>";
    }
    echo '</ul>';
  }

}
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
  }

  /**
   * Action Methods
   */
  public function all()
  {
    $suppliers = $this->controller->getSuppliers();
    include "templates/header.php";  
    include "pages/supplier/all.php";
    include "templates/footer.php";
  }

}
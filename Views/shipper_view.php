<?php

/**
* The Shipper page view
*/
class ShipperView
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
    $shippers = $this->controller->getShippers();
    include "templates/header.php";  
    include "pages/shipper/all.php";
    include "templates/footer.php";
  }
  
}
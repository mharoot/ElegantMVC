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

      print "Shippers - ";
  }

  /**
   * Action Methods
   */
  public function shippers()
  {
    print "shippers";
    $shippers = $this->controller->getShippers();
    echo '<ul>';
    foreach(  $shippers as $shipper)
    {
      echo "<li>
              <ul>
                  <li>ShipperID: $shipper->ShipperID</li>
                  <li>ShipperName: $shipper->ShipperName </li>  
                  <li>Phone: $shipper->Phone </li>
              </ul>
            </li>";
    }
    echo '</ul>';
  }
}
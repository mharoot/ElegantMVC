<?php

/**
* The Shippers page view
*/
class ShippersView
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
        $shippers = $this->controller->shippers();
        echo '<ul>';
        foreach(  $shippers as $shipper)
        {
            echo "<li>
                    <ul>
                        <li>ShipperID: $shipper->ShipperID</li>
                        <li>ShipperName: $shipper->ShipperName </li>  
                        <li>EmployeeID: $shipper->EmployeeID </li>
                    </ul>
                    </li>";
        }
        echo '</ul>';
    }
}
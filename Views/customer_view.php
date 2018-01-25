<?php

    /**
    * The about page view
    */
    class CustomerView
    {

        private $modelObj;

        private $controller;


        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->modelObj = $model;

            print "Customer - ";
        }

        public function orders()
        {
            print "Orders";
            $orders = $this->controller->orders();
            echo '<ul>';
            foreach(  $orders as $order)
            {
                echo "<li>
                        <ul>
                            <li>CustomerID: $order->CustomerID</li>
                            <li>CustomerName: $order->CustomerName </li>
                            <li>Address: $order->Address</li>
                            <li>City: $order->City</li>
                            <li>PostalCode: $order->PostalCode</li>
                            <li>Country: $order->Country</li>
                            <li>OrderID: $order->OrderID</li>
                            <li>EmployeeID: $order->EmployeeID </li>
                            <li>OrderDate: $order->OrderDate</li>
                            <li>ShipperID: $order->ShipperID</li>
                        </ul>
                      </li>";
            }
            echo '</ul>';
        }

        // public function today()
        // {
        //     return $this->controller->current();
        // }


    }
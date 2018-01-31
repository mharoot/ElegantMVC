<?php

    /**
    * The Employees page view
    */
    class OrderDetailView
    {

        private $modelObj;

        private $controller;


        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->modelObj = $model;

            print "Order Details - ";
        }



         public function get()
        {
            print "All";
            $orderdetails = $this->controller->getOrderDetails();
            echo '<ul>';
            foreach(  $orderdetails as $orderdetail)
            {
                echo "<li>
                        <ul>
                            <li>OrderDetailID: $orderdetail->OrderDetailID</li>
                            <li>OrderID: $orderdetail->OrderID </li>
                            <li>ProductID: $orderdetail->ProductID</li>
                            <li>Quantity: $orderdetail->Quantity</li>
                        </ul>
                      </li>";
            }
            echo '</ul>';
        }
        /**
         * Action Methods
         */
    }
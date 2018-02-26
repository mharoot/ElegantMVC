<?php
    /**
    * The Customer page view
    */
    class CustomerView
    {
        
        function __construct()
        {

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

        public function reviewBillingInformation($info)
        {

            $_SESSION['content'] .= require_once 'pages/customer/reviewBillingInformation.php';
            require_once 'layout.html';
        }
        
        
        public function editBillingInformation($info)
        {
          
            $_SESSION['content'] .= require_once 'pages/customer/editBillingInformation.php';
            require_once 'layout.html';
        }
        
       
        
        // public function today()
        // {
        //     return $this->controller->current();
        // }
    }
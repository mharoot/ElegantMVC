<?php
    /**
    * The Customer page view
    */
    class CustomerView
    {
        
        function __construct()
        {

        }


        public function reviewBillingInformation($customer_info)
        {

            require_once 'pages/templates/header.php';    
            require_once 'pages/customer/reviewBillingInformation.php';
            require_once 'pages/templates/footer.php';
        }
        
    }
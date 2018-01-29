<?php

    /**
    * The about page controller
    */
    class CustomerController
    {
        private $modelObj;

        function __construct( $model )
        {
            $this->modelObj = $model;

        }

        public function orders()
        {
            return $this->modelObj->getCustomerOrders();
        }
     }
<?php

    /**
    * The Order Detail page controller
    */
    class OrderDetailController
    {
        private $modelObj;

        function __construct( $model )
        {
            $this->modelObj = $model;

        }

        public function getOrderDetails()
        {
            return $this->modelObj->getOrderDetails();
        }

     }
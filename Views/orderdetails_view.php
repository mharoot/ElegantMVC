<?php

    /**
    * The OrderDetails page view
    */
    class OrderDetailsView
    {

        private $modelObj;

        private $controller;


        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->modelObj = $model;

            print "Order Details - ";
        }

        /**
         * Action Methods
         */
        
    }
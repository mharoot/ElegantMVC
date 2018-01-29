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
        
    }
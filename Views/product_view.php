<?php

    /**
    * The Product page view
    */
    class ProductView
    {

        private $modelObj;

        private $controller;


        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->modelObj = $model;

            print "Products - ";
        }

        /**
         * Action Methods
         */
        
    }
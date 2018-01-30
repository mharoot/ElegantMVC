<?php

    /**
    * The Products page view
    */
    class ProductsView
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
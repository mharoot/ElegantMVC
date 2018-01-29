<?php

    /**
    * The Suppliers page view
    */
    class SuppliersView
    {

        private $modelObj;

        private $controller;


        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->modelObj = $model;

            print "Suppliers - ";
        }

        /**
         * Action Methods
         */
        
    }
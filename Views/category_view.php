<?php

    /**
    * The Category page view
    */
    class CategoryView
    {

        private $modelObj;

        private $controller;


        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->modelObj = $model;

            print "Categories - ";
        }

        /**
         * Action Methods
         */
        
    }
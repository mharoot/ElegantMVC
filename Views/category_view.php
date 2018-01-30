<?php

    /**
    * The Categories page view
    */
    class CategoriesView
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
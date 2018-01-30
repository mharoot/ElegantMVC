<?php

    /**
    * The Employees page view
    */
    class EmployeeView
    {

        private $modelObj;

        private $controller;


        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->modelObj = $model;

            print "Employees - ";
        }

        /**
         * Action Methods
         */
        
    }
<?php

    /**
    * The Employees page view
    */
    class EmployeesView
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
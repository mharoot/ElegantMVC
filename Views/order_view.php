<?php

    /**
    * The Order page view
    */
    class OrderView
    {

        private $modelObj;

        private $controller;


        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->modelObj = $model;

            print "Orders - ";
        }

        /**
         * Action Methods
         */
        
    }
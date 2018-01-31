<?php

    /**
    * The Employees page controller
    */
    class EmployeeController
    {
        private $modelObj;

        function __construct( $model )
        {
            $this->modelObj = $model;

        }

        public function getEmployee()
        {
            return $this->modelObj->getEmployeesList();
        }

     }
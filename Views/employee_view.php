<?php

    /**
    * The Employees page view
    */
    class EmployeeView
    {


        function __construct()
        {

        }



        public function reviewEmployeeInformation($employee_info)
        {
            require_once 'pages/templates/header.php';
            require_once 'pages/employee/review-employee-information.php';
            require_once 'pages/templates/footer.php';
               
        }


        public function displayEmployeeInformation($employee_info)
        {
          require_once 'pages/templates/header.php';
          require_once 'pages/employee/review-employee-information.php';
          require_once 'pages/templates/footer.php';
        }
       
    }
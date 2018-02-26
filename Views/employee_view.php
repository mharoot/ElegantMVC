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



         public function get()
        {
            print "All";
            $employees = $this->controller->getEmployee();
            echo '<ul>';
            foreach(  $employees as $employee)
            {
                echo "<li>
                        <ul>
                            <li>EmployeeID: $employee->EmployeeID</li>
                            <li>LastName: $employee->LastName </li>
                            <li>FirstName: $employee->FirstName</li>
                            <li>BirthDate: $employee->BirthDate</li>
                            <li>Photo: $employee->Photo</li>
                            <li>Notes: $employee->Notes</li>
                        </ul>
                      </li>";
            }
            echo '</ul>';
        }
        /**
         * Action Methods
         */
    }
<?php
    /**
    * The Customer page controller
    */
    class EmployeeController
    {
        private $model;
        private $view;
        function __construct()
        {
            $this->model = new EmployeeModel();
            $this->view = new EmployeeView();
        }
        public function displayEmployeeInformation()
        {
            $employee_info = $this->model->getEmployee();
            $this->view->reviewEmployeeInformation($employee_info);
        }

        public function editEmployeeInformation($LastName, $FirstName, $BirthDate, $Photo, $Notes)
        {
            
           $employee_info_edited = $this->model->editEmployeeInformation($LastName, $FirstName, $BirthDate, $Photo, $Notes);

           if ( $employee_info_edited )
           {
               $_SESSION['success_message'] = "Employee info edited!";
           }
           else
           {
               $_SESSION['error_message'] = "Failed to edit Employee info!";
           }           

           $employee_info = $this->model->getEmployee();
           $this->view->reviewEmployeeInformation($employee_info);

        }
     }
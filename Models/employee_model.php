<?php 
declare(strict_types=1);

class EmployeeModel extends Model
{

    public function __construct()
    {
        $this->table_name = "employees";
        parent::__construct($this);
    }

    /**
     * Searches the employees table using foreign key = $_SESSION['user_id']
     * @return EmployeeModel with all columns of that user_id or FALSE
     */
	private function getEmployee()
	{
		return $this->where('UserID', '=', $_SESSION['user_id'])
					->single();
	}


 	/**
     * Searches the employees table using foreign key = $_SESSION['user_id']
     * Update if employee exists or insert if employee does not exist
     * @return true if successfully inserted or updated Employee Information
     */
    public function editEmployeeInformation()
    {
        $employee = $this->getEmployee();
        if (isset($employee))
        {
            // get ready to update
            
        }
        else
        {
            // get ready to insert

        }
    }




















    public function getEmployees()
    {
        return $this->get();
    }







    public function getEmployees()
    {
        return $this->get();
    }

}
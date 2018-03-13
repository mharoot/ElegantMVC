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
    public function editEmployeeInformation($LastName, $FirstName, $BirthDate, $Photo, $Notes)
    {
        $employee_info_edited = false;

        $this->LastName  = $LastName;
        $this->FirstName = $FirstName;
        $this->BirthDate = $BirthDate;
        $this->Photo     = $Photo;
        $this->Notes     = $Notes;

        $employee = $this->getEmployee();

        if ($employee !== false)
        {
            // update
            $employee_info_edited = $this->where('UserID', '=', $_SESSION['user_id'])
                                         ->save();
            
        }
        else
        {
            // insert
            $this->UserID = $_SESSION['user_id'];
            $employee_info_edited = $this->save();
        }

        return $employee_info_edited;
    }




















    public function getEmployees()
    {
        return $this->get();
    }


}
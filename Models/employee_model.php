<?php 
declare(strict_types=1);

class EmployeeModel extends Model
{

    public function __construct()
    {
        $this->table_name = "employees";
        parent::__construct($this);
    }

    public function getEmployees()
    {
        return $this->get();
    }

}
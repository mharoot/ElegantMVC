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

    
    
    public function getAllShippers()
    {
        $shippers = new ShipperModel();
        return $shippers->get();
    }
    /**
     * As an Employee I want to be able to view customer orders that I had the responsibility of full-filling.
     * Im interested in the status for javascript filter, picking a shipping company, and thats it. 
     */
    public function getCustomerOrders()
    {
        $employee = $this->getEmployee(); // get logged in employee
        // $OrderModel = new OrderModel();
        return $this->oneToMany('orders', 'EmployeeID', 'EmployeeID')
                    ->where('orders.EmployeeID', '=', $employee->EmployeeID)
                    ->orWhere('orders.EmployeeID', '=',  0)
                    ->get(["orders.*"]);
        // $pendingOrders = $OrderModel->where('EmployeeID', '=', 0)->get();
        // $filledOrders  = $OrderModel->where('EmployeeID', '=', $employee->EmployeeID)->get();
        // $allOrders = array_merge($pendingOrders , $filledOrders );
        // return $allOrders;
                            
    }

    
    /**
     * Searches the employees table using foreign key = $_SESSION['user_id']
     * @return EmployeeModel with all columns of that user_id or FALSE
     */
    public function getEmployee()
    {
        return $this->where('UserID', '=', $_SESSION['user_id'])
                    ->single();
    }

    public function getEmployees()
    {
        return $this->get();
    }

    public function getSuppliers()
    {
        $SupplierModel = new SupplierModel();
        return $SupplierModel->get();
    }

    public function shipOrder($OrderID, $ShipperID)
    {
        $EmployeeID = $this->getEmployee()->EmployeeID; 
        
        $OrderModel = new OrderModel();
        $OrderModel->ShipperID = $ShipperID;
        $OrderModel->EmployeeID = $EmployeeID;
        $OrderModel->OrderStatus = 1; //shipped 
       
       return $OrderModel->where('OrderID', '=', $OrderID)
                         ->save();
        
    }

}
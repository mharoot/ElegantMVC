<?php 
declare(strict_types=1);

class SupplierModel extends Model
{

    public function __construct()
    {
        $this->table_name = "suppliers";
        parent::__construct($this);
    }

    public function getSuppliers()
    {
        return $this->get();
    }

    /**
     * Searches the suppliers table using foreign key = $_SESSION['user_id']
     * @return SupplierModel with all columns of that user_id or FALSE
     */
    private function getSupplier()
    {
        return $this->where('UserID', '=', $_SESSION['user_id'])
             ->single();
    }

    /**
     * Searches the suppliers table using foreign key = $_SESSION['user_id']
     * 
     * @return true if sucessfully inserted or updated Buisness Information
     */
    public function editBuisnessInformation()
    {
        $supplier = $this->getSupplier();
        if (isset($supplier))
        {
            // get ready to update
            
        }
        else
        {
            // get ready to insert

        }
    }

}
<?php 
declare(strict_types=1);

class SupplierModel extends Model
{

    public function __construct()
    {
        $this->table_name = "suppliers";
        parent::__construct($this);
    }






    /**
     * Searches the suppliers table using foreign key = $_SESSION['user_id']
     * @return SupplierModel with all columns of that user_id or FALSE
     */
    public function getSupplier()
    {
        return $this->where('UserID', '=', $_SESSION['user_id'])
             ->single();
    }














    /**
     * Searches the suppliers table using foreign key = $_SESSION['user_id']
     * Update if supplier exists or insert if supplier does not exist
     * @return true if successfully inserted or updated Business Information
     */
    public function editBusinessInformation($SupplierName, $ContactName, $Address, $City, $PostalCode, $Country, $Phone)
    {
        $business_info_edited = false;

        $this->SupplierName = $SupplierName;
        $this->ContactName  = $ContactName;
        $this->Address      = $Address;
        $this->City         = $City;
        $this->PostalCode   = $PostalCode;
        $this->Country      = $Country;
        $this->Phone        = $Phone;

        $supplier = $this->getSupplier();

        if ($supplier !== false)
        {
            // update
            $business_info_edited = $this->where('UserID', '=', $_SESSION['user_id'])
                                         ->save();
        }
        else
        {
            // insert
           $this->UserID = $_SESSION['user_id'];
           $business_info_edited = $this->save();
        }

        return $business_info_edited;
    }













    public function getSuppliers()
    {
        return $this->get();
    }









    

}
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



    public function editProductInformation($ProductName, $CategoryID, $Unit, $Price, $Quantity)
    {
        $product_info_edited = false;
        
        $product = $this->getSupplierProduct($_SESSION['ProductID']); 
        $SupplierID = $this->getSupplierID();

        $product_model = new ProductModel();

        $product_model ->ProductName = $ProductName;
        $product_model ->CategoryID  = $CategoryID;
        $product_model ->Unit        = $Unit;
        $product_model ->Price       = $Price;
        $product_model ->Quantity    = $Quantity;

        if ($product !== false)
        {
            // update
            $product_info_edited = $product_model
                                        ->where('ProductID', '=', $_SESSION['ProductID'])
                                        ->where('SupplierID', '=', $SupplierID) // for security purposes, this prevents a supplier from updating another supplier's products through html injection
                                        ->save();
        }
        else
        {
            // insert
           $product_model->SupplierID = $SupplierID;
           $product_info_edited = $product_model->save();
        }

        return $product_info_edited;
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
     * Searchers the suppliers table using foreign key = $_SESSION['user_id']
     * @return int SupplierID
     */
    public function getSupplierID()
    {
        if (!isset($_SESSION['SupplierID']))
        {
            $_SESSION['SupplierID'] = $this->where('UserID', '=', $_SESSION['user_id'])
                                           ->single(['SupplierID'])
                                           ->SupplierID;
        }

        return  $_SESSION['SupplierID'] ;
    }
    


    /**
     * Get the product by the product id, associated with the supplier.
     * @return SupplierModel with all columns from both the supplier and products table
     */
    public function getSupplierProduct($ProductID) 
    {
        $supplier_id = $this->getSupplierID();
        $foreign_table = 'products';
        $primary_key   = 'SupplierID';
        $foreign_key   = 'SupplierID';
        $avoid_ambiguity_in_where_clause = $foreign_table.'.'.$foreign_key;

        $supplier_product = $this->oneToMany($foreign_table, $primary_key, $foreign_key)
                                  ->where($avoid_ambiguity_in_where_clause, '=', $supplier_id)
                                  ->where('ProductID', '=', $ProductID)
                                  ->single();
        $_SESSION['ProductID'] = $ProductID;

        return $supplier_product;
    }



    /**
     * Get the products associated with the supplier.
     * @return SupplierModel[] with all columns from both the supplier and products table
     */
    public function getSupplierProducts()
    {
        $supplier_id = $this->getSupplierID();
        $foreign_table = 'products';
        $primary_key   = 'SupplierID';
        $foreign_key   = 'SupplierID';
        $avoid_ambiguity_in_where_clause = $foreign_table.'.'.$foreign_key;

        $supplier_products = $this->oneToMany($foreign_table, $primary_key, $foreign_key)
                                  ->where($avoid_ambiguity_in_where_clause, '=', $supplier_id)
                                  ->get();

        return $supplier_products;
    }



    public function getSuppliers()
    {
        return $this->get();
    }









    

}
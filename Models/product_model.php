<?php 
declare(strict_types=1);

    class ProductModel extends Model
    {

        public function __construct()
        {
            $this->table_name = "products";
            parent::__construct($this);
        }

        public function getProducts()
        {
            $Products = $this->oneToOne('categories', 'CategoryID', 'CategoryID')
                        ->get();

            foreach ($Products as $Product) {
                $Product->SupplierName = $this->oneToOne('suppliers', 'SupplierID', 'SupplierID')
                        ->where('suppliers.SupplierID', '=', $Product->SupplierID)
                        ->single()->SupplierName;
            }

            return $Products;
        }

        public function getProductsByCategoryID($id)
        {
            $Products = $this->oneToOne('categories', 'CategoryID', 'CategoryID')
                        ->where('categories.CategoryID', '=', $id)
                        ->get();

            foreach ($Products as $Product) {
                $Product->SupplierName = $this->oneToOne('suppliers', 'SupplierID', 'SupplierID')
                        ->where('suppliers.SupplierID', '=', $Product->SupplierID)
                        ->single()->SupplierName;
            }

            return $Products;
        }

    }
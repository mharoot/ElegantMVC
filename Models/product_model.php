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
        	return $this->get();
        }

    }
<?php 
declare(strict_types=1);

    class ProductView
    {

        public function __construct()
        {
    
        }

        public function products($products)
        {
            require_once 'pages/templates/header.php';
            require_once 'pages/product/products.php';
           
        }
     
    }
<?php 
declare(strict_types=1);

    class ProductView
    {

        public function __construct()
        {
    
        }

        public function selectProduct($product)
        {

            require_once 'pages/templates/header.php';
            require_once 'pages/product/selectproduct.php';
            require_once 'pages/templates/footer.php';

        }

        public function products($products,$category)
        {
            require_once 'pages/templates/header.php';
            require_once 'pages/product/products.php';
            require_once 'pages/templates/footer.php';
           
        }
     
    }
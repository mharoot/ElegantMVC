<?php 
declare(strict_types=1);

    class ProductView
    {

        public function __construct()
        {
    
        }

        public function products($products)
        {
            
            $_SESSION['content'] .= require_once 'pages/product/products.php';
            require_once 'layout.html';
        }
     
    }
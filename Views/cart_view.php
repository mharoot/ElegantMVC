<?php

declare(strict_types=1);

    class CartView
    {

        public function __construct()
        {
    
        }


        public function items($items)
        {

            require_once 'pages/templates/header.php';
            if(isset($items['product'][0]))
            {
                require_once 'pages/cart/items.php';
            }else{
                echo "<h2> No items in your cart. </h2>";
            }
            require_once 'pages/templates/footer.php';
        }

        public function checkout($items)
        {
            require_once 'pages/templates/header.php';
            if(isset($items['product'][0]))
            {
                require_once 'pages/cart/checkout.php';
            }else{
                echo "<h2> No items in your cart. </h2>";
            }
            require_once 'pages/templates/footer.php';
        }


        public function wishlist($items)
        {
            require_once 'pages/templates/header.php';
            if(isset($items['product'][0]))
            {
                $products = $items['product'];
                require_once 'pages/cart/wishlist.php';
            }else{
                echo "<h2> No items in your wishlist. </h2>";
            }
            require_once 'pages/templates/footer.php';
        }

       
     
    }
<?php

    class CartModel
    {

        

        function __construct()
        {

        }

        public function initCart()
        {
           if(!isset($_COOKIE["guest_cart"])) {
                $cookie_name = "guest_cart";
                setcookie($cookie_name, $cookie_name, time() + (86400 * 30), "/");
            } else {
                

            } 
            echo "</br></br></br></br></br>";
            var_dump($_COOKIE);
        }


     

    }
?>
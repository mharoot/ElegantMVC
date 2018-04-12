<?php 
declare(strict_types=1);

    class CartController
    {

        
        private $view;
        private $model;
        public function __construct()
        {
            $this->view = new CartView();
            $this->model = new CartModel();
        }

        public function displayCart()
        {
            if(isset($_SESSION['user_id']))
            {
                /* combine guest cart and empty it out  first time*/

                $this->view->displayItems($items);
            }
            else
            {

                $product = new ProductModel();

                $products = $product->get();

                $cart = json_decode($_COOKIE['guest_cart'],true);

                $items = [];
                $items['product'] = [];
                $items['quantity'] = [];
                foreach ($products as $p) {
                    $id = $p->ProductID;
                    if(isset($cart[$id]))
                    {
                        if($cart[$id]>0)
                        {

                            array_push($items['product'],$p);
                            array_push($items['quantity'],[$id => $cart[$id]]);
                        }
                    }
                }
                

                $this->view->items($items);
            }
        }

        public function addCart($id)
        {
            if(isset($_SESSION['user_id']))
            {
                /* combine guest cart and empty it out  first time*/

                
            }
            else
            {
              
              $items = json_decode($_COOKIE['guest_cart'],true);


              $items[$id]+=1;

              setcookie('guest_cart', json_encode($items) , time() + (86400 * 30), "/");



            }

            header('Location: ./products');
        }

        public function updateCart($p)
        {

            $items = json_decode($_COOKIE['guest_cart'],true);

            $index = 0;
            for ($i=1; $i < count($items) ; $i++) { 
                
                if($items[$i] > 0)
                {
                    $items[$i] = $p[$index];
                    $index++;
                }
            }
            
            setcookie('guest_cart', json_encode($items) , time() + (86400 * 30), "/");
            header('Location: ./cart');
        }

     
        
    



}
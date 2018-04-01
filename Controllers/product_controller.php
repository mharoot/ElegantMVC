<?php 
declare(strict_types=1);

    class ProductController
    {

        
        private $view;
        private $model;
        public function __construct()
        {
            $this->view = new ProductView();
            $this->model = new ProductModel();
        }

        public function displayProducts($id=null)
        {
            if($id == null)
            {
                $products = $this->model->getProducts();
        	   $this->view->products($products);
            }
            else
            {
                $products = $this->model->getProductsByCategoryID($id);
                $this->view->products($products);
            }
        }

    public function searchProducts($query)
    {

        $products = $this->model->getProducts();

        $a = [];

        foreach ($products as $p) {
            array_push($a,$p->ProductName);
        }

        // get the q parameter from URL
        $q = $query;

        $hint = "";

        // lookup all hints from array if $q is different from "" 
        if ($q !== "") {
            $q = strtolower($q);
            $len=strlen($q);
            foreach($a as $name) {
                if (stristr($q, substr($name, 0, $len))) {
                    if ($hint === "") {
                        $hint = $name;
                    } else {
                        $hint .= ", $name";
                    }
                }
            }
        }

        // Output "no suggestion" if no hint was found or output correct values
        echo $hint === "" ? "no suggestion" : $hint;
        


    }
    



    }
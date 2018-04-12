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
            $Cat = new CategoryModel();
            $category = $Cat->get();
            if($id == null)
            {

                $products = $this->model->get();
               $this->view->products($products,$category);
            }
            else
            {
                $products = $this->model->where('CategoryID', '=', $id)->get();
                $this->view->products($products,$category);
            }
        }

        public function selectProduct($title)
        {
            $product = $this->model->where('ProductName', '=', $title)->get();
            $this->view->selectProduct($product);
        }

        public function searchProducts($query)
        {

        $products = $this->model->get();

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
                        $hint = '<a id ="firstElement" class="dropdown-item" href = "./select?q='.$name.'">'.$name.'</a>';
                    } else {
                        $hint .= '<a class="dropdown-item" href = "./select?q='.$name.'">'.$name.'</a>';
                    }
                }
            }
        }

        // Output "no suggestion" if no hint was found or output correct values
        echo $hint === "" ? "no suggestion" : $hint;
        


    }
    



    }
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
                $products = $this->model->get();
        	   $this->view->products($products);
            }
            else
            {
                $products = $this->model->where('CategoryID', '=', $id)->get();
                $this->view->products($products);
            }
        }



    }
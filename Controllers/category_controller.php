<?php 
declare(strict_types=1);

    class CategoryController
    {

        
        private $view;
        private $model;
        public function __construct()
        {
            $this->view = new CategoryView();
            $this->model = new CategoryModel();
        }

        public function displayCategory()
        {
            $categories = $this->model->get();
        	$this->view->categories($categories);
        }


    }
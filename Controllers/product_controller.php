<?php 
declare(strict_types=1);

    class ProductController
    {

        private $model;

        public function __construct($model)
        {
            $this->model = $model;
        }

        public function products()
        {
        	return $this->model->getProducts();
        }

    }
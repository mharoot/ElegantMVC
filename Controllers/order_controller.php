<?php 
declare(strict_types=1);

    class OrderController
    {

        private $model;

        public function __construct($model)
        {
            $this->model = $model;
        }

    }
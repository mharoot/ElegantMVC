<?php 
declare(strict_types=1);

    class ProductView
    {

        private $controller;
        private $model;

        public function __construct($controller, $model)
        {
            $this->controller = $controller;
            $this->model = $model;
            echo "Products Page";
        }

        public function products()
        {
            $products = $this->model->getProducts();

            foreach ($products as $p) {
                echo "<p>".$p->ProductName ."</p>";
                echo "<p>".$p->SupplierID ."</p>";
                echo "<p>".$p->CategoryID ."</p>";
                echo "<p>".$p->Unit ."</p>";
                echo "<p>".$p->Price ."</p>";
                echo "<br><br></br></br>";
            }
        }

        public function test()
        {
            echo "Testing";
        }

    }
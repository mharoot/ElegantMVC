<?php 
declare(strict_types=1);

    class OrderView
    {

        private $controller;
        private $model;

        public function __construct($controller, $model)
        {
            $this->controller = $controller;
            $this->model = $model;
            echo "Orders Page";
        }

        public function orders()
        {
            $orders = $this->model->getOrders();

            foreach ($orders as $o) {
                echo "<p>".$o->EmployeeID ."</p>";
                echo "<p>".$o->OrderDate ."</p>";
                echo "<p>".$o->ShipperID ."</p>";
                echo "<p>".$o->CustomerID ."</p>";
                echo "<br><br></br></br>";
            }
        }

        public function test()
        {
            echo "Testing";
        }


    }
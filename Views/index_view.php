<?php

    /**
    * The home page view
    */
    class IndexView
    {

        private $model;

        private $controller;


        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->model = $model;
        }

        public function index()
        {
            include "templates/header.php";  
            echo "<h1>".$this->controller->sayWelcome()."</h1>";
            include "templates/footer.php";  
            
        }

        public function action()
        {
            return $this->controller->takeAction();
        }

    }

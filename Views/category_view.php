<?php

    /**
    * The Categories page view
    */
    class CategoryView
    {

        private $modelObj;

        private $controller;


        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->modelObj = $model;

            //print "Categories - ";
			//$this->categories();
        }

        /**
         * Action Methods
         */
		 
		public function categories()
        {
            $categories = $this->controller->showCategories();
            include "templates/header.php";  
            include "pages/category/all.php";
            include "templates/footer.php";

        }
		
		public function create()
		{
			$this->modelObj->create('New Category','test category');
		}
        
		public function hello()
		{
			echo 'hello';
		}
    }
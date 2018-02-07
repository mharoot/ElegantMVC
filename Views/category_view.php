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

            print "Categories - ";
			$this->categories();
        }

        /**
         * Action Methods
         */
		 
		public function categories()
        {
            $categories = $this->controller->showCategories();
			echo '<table>';
			foreach ($categories as $category)
			{
				echo "<tr><td>$category->CategoryID</td><td>$category->CategoryName</td><td>$category->Description</td></tr>";
			}
			echo '</table>';
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
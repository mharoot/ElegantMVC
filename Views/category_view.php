<?php

    /**
    * The Categories page view
    */
    class CategoryView
    {


        function __construct()
        {

        }


		 
		public function categories($categories)
        {
            require_once 'pages/category/categories.php';
            require_once 'pages/templates/footer.php';
        }
		

    }
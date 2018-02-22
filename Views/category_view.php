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
            $_SESSION['content'] .= require_once 'pages/category/categories.php';
            require_once 'layout.html';
        }
		

    }
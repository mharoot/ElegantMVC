<?php

    /**
    * The Categories page controller
    */
    class CategoriesController
    {
        private $modelObj;

        function __construct( $model )
        {
            $this->modelObj = $model;

        }

        /**
         * Public methods
         */
		 
		public function showCategories()
        {
            return $this->modelObj->getCategories();
        }

     }
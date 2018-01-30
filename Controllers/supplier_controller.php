<?php

    /**
    * The Supplier page controller
    */
    class SupplierController
    {
        private $modelObj;

        function __construct( $model )
        {
            $this->modelObj = $model;

        }

        /**
         * Public methods
         */
        public function getSuppliers()
        {
            return $this->modelObj->getAllSuppliers();
        }
     }
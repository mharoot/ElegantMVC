<?php

    /**
    * The Shipper page controller
    */
    class ShipperController
    {
        private $modelObj;

        function __construct( $model )
        {
            $this->modelObj = $model;

        }

        /**
         * Public methods
         */
        public function getShippers()
        {
            return $this->modelObj->getAllShippers();
        }

     }
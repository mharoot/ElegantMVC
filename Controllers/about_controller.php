<?php

    /**
    * The about page controller
    */
    class AboutController
    {
        private $modelObj;

        function __construct( $model )
        {
            $this->modelObj = $model;

        }

        public function current()
        {
            $this->modelObj->setMessage("About us today changed by aboutController.");
            return $this->modelObj->getMessage();
        }
     }
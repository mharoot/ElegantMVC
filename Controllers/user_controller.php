<?php

    /**
    * The User page controller
    */
    class UserController
    {
        private $modelObj;

        function __construct( $model )
        {
            $this->modelObj = $model;

        }

        /**
         * Public methods
         */
        public function getUsers()
        {
            return $this->modelObj->getAllUsers();
        }
     }
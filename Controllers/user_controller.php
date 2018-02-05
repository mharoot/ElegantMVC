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

        public function getUser($param)
        {
            $id = $param[0];
            return $this->modelObj->getUserByID($id);
        }

        public function login($user_name, $password, $remember_me)
        {
            return $this->modelObj->loginWithPostData($user_name, $password, $remember_me);
        }
     }
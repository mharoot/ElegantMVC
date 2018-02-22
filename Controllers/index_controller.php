<?php

    /**
    * The Home page controller
    */
    class IndexController
    {
        private $view;

        function __construct()
        {
          
        }

        public function index()
        {
            $content = null;
            require_once 'layout.html';
        }


    }
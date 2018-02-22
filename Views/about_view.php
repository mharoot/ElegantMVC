<?php

    /**
    * The About page view
    */
    class AboutView
    {

        function __construct()
        {

        }

        public function model()
        {
            $_SESSION['content'] .= require_once 'pages/about/model.php';
            require_once 'layout.html';
        }


    }
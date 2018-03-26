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
            require_once 'pages/templates/header.php';    require_once 'pages/about/model.php';
            require_once 'pages/templates/footer.php';
        }

        public function queryBuilder()
        {
            require_once 'pages/templates/header.php';    require_once 'pages/about/query-builder.php';
            require_once 'pages/templates/footer.php';
        }

        public function dbUML()
        {
            require_once 'pages/emvc-db-uml.html';
        }


    }
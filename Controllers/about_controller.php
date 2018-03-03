<?php

    /**
    * The About page controller
    */
    class AboutController
    {
        private $model;
        private $view;

        function __construct()
        {
            $this->model = new AboutModel();
            $this->view = new AboutView();

        }

        public function aboutModel()
        {
            $this->view->model();
        }

        public function aboutQueryBuilder()
        {
            $this->view->queryBuilder();
        }

        public function dbUML()
        {
            $this->view->dbUML();
        }
     }
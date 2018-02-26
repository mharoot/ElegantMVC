<?php 
declare(strict_types=1);

    class SupplierController
    {

        
        private $view;
        private $model;
        public function __construct()
        {
            $this->view = new SupplierView();
            $this->model = new SupplierModel();
        }

        public function displaySupplier()
        {
            $suppliers = $this->model->getSuppliers(); 
        	$this->view->suppliers($suppliers);
        }


    }
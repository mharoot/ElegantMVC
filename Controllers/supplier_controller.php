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

        public function displayReviewBuisnessInformation()
        {
            $supplier = $this->model->getSupplier();
            $this->view->displayReviewBuisnessInformation($supplier);
        }

        public function displaySupplier()
        {
            $suppliers = $this->model->getSuppliers(); 
        	$this->view->suppliers($suppliers);
        }
        

        public function editBusinessInformation($SupplierName, $ContactName, $Address, $City, $PostalCode, $Country, $Phone)
        {
            $buisness_info_edited = $this->model->editBusinessInformation($SupplierName, $ContactName, $Address, $City, $PostalCode, $Country, $Phone);
            $supplier_info;
            if ( $buisness_info_edited )
            {
                $supplier_info = $this->model->getSupplier();
            }
            $this->view->reviewBusinessInformation($buisness_info_edited, $supplier_info);
        }

    }
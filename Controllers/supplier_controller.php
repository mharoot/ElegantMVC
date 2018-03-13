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



        public function displayReviewBusinessInformation()
        {
            $supplier_info = $this->model->getSupplier();
            $this->view->reviewBusinessInformation($supplier_info);
        }
        


        public function editBusinessInformation($SupplierName, $ContactName, $Address, $City, $PostalCode, $Country, $Phone)
        {
            $business_info_edited = $this->model->editBusinessInformation($SupplierName, $ContactName, $Address, $City, $PostalCode, $Country, $Phone);

            if ( $business_info_edited )
            {
                $_SESSION['success_message'] = "Business info edited!";
            }
            else
            {
                $_SESSION['error_message'] = "Failed to edit business info!";
            }            

            $supplier_info = $this->model->getSupplier();
            $this->view->reviewBusinessInformation($supplier_info);
        }


        public function displayAllSuppliers()
        {
            $suppliers = $this->model->getSuppliers(); 
        	$this->view->suppliers($suppliers);
        }

    }
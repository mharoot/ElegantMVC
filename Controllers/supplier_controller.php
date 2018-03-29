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



        public function displayAllSuppliers()
        {
            $suppliers = $this->model->getSuppliers(); 
        	$this->view->suppliers($suppliers);
        }



        public function displayProductForm($ProductID)
        {
            $supplier_product = $this->model->getSupplierProduct($ProductID);
            $this->view->updateProductForm($supplier_product);
        }



        public function displayReviewBusinessInformation()
        {
            $supplier_info = $this->model->getSupplier();
            $this->view->reviewBusinessInformation($supplier_info);
        }




        public function displaySupplierProducts()
        {
            $supplier_products = $this->model->getSupplierProducts();
            $this->view->allSupplierProducts($supplier_products);
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



        public function editProductInformation($ProductName, $CategoryID, $Unit, $Price, $Quantity)
        {
            $product_info_edited = $this->model->editProductInformation($ProductName, $CategoryID, $Unit, $Price, $Quantity);

            if ( $product_info_edited )
            {
                $_SESSION['success_message'] = "Product info edited!";
            }
            else
            {
                $_SESSION['error_message'] = "Failed to edit business info!";
            }            

            //$this->displaySupplierProducts();
            header('Location: ./view-all-supplier-products');
        }




    }
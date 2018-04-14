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


        public function deleteProduct($ProductID)
        {
           $SupplierID =  $this->model->getSupplierID();
           var_dump($SupplierID);

            // delete
            $product_model = new ProductModel();
            $product_deleted = $product_model
            ->where('ProductID', '=', $ProductID)
            ->where('SupplierID', '=', $SupplierID) // for security purposes, this prevents a supplier from deleting another supplier's products through html injection
            ->delete();


            if ( $product_deleted )
            {
                $_SESSION['success_message'] = "Product Deleted Successfully!";
            }
            else
            {
                $_SESSION['error_message'] = "Failed to Delete Product!";
            }   

            header('Location: ./view-all-supplier-products');



        }

        public function displayAllSuppliers()
        {
            $suppliers = $this->model->getSuppliers(); 
        	$this->view->suppliers($suppliers);
        }



        public function displayProductForm($ProductID = NULL)
        {
            $supplier_product = false;
            if (isset($ProductID))
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

            $this->displayReviewBusinessInformation();
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
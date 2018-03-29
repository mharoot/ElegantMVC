<?php

/**
* The Supplier page view
*/
class SupplierView
{

  public function allSupplierProducts($supplier_products)
  {
    require_once 'pages/templates/header.php';    
    require_once 'pages/supplier/view-all-supplier-products.php';
    require_once 'pages/templates/footer.php';
  }

  public function reviewBusinessInformation($supplier_info)
  {
    require_once 'pages/templates/header.php';    
    require_once 'pages/supplier/review-business-information.php';
    require_once 'pages/templates/footer.php';
  }

  public function suppliers($suppliers)
  {
    require_once 'pages/templates/header.php';    
    require_once 'pages/supplier/suppliers.php';
    require_once 'pages/templates/footer.php';
  }

  public function updateProductForm($supplier_product)
  {
    require_once 'pages/templates/header.php';    
    require_once 'pages/supplier/update-product-form.php';
    require_once 'pages/templates/footer.php';
  }




  
}
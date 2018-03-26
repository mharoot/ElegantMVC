<?php

/**
* The Supplier page view
*/
class SupplierView
{
  public function suppliers($suppliers)
  {
    require_once 'pages/templates/header.php';    require_once 'pages/supplier/suppliers.php';
    require_once 'pages/templates/footer.php';
  }



  public function reviewBusinessInformation($supplier_info)
  {
    require_once 'pages/templates/header.php';    require_once 'pages/supplier/review-business-information.php';
    require_once 'pages/templates/footer.php';
  }

  
}
<?php

/**
* The Supplier page view
*/
class SupplierView
{
  public function suppliers($suppliers)
  {
    $_SESSION['content'] .= require_once 'pages/supplier/suppliers.php';
    require_once 'layout.html';
  }



  public function reviewBusinessInformation($supplier_info)
  {
    $_SESSION['content'] .= require_once 'pages/supplier/review-business-information.php';
    require_once 'layout.html';
  }

  
}
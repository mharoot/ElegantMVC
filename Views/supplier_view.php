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


  public function displayReviewBuisnessInformation($supplier_info)
  {
    $buisness_info_edited = isset($supplier_info) ? true : false;
    $_SESSION['content'] .= require_once 'pages/supplier/review-business-information.php';
    require_once 'layout.html';
  }

  public function reviewBusinessInformation($buisness_info_edited, $supplier_info)
  {
    $_SESSION['content'] .= require_once 'pages/supplier/review-business-information.php';
    require_once 'layout.html';
  }
}
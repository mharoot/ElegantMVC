<?php
/**
* The Customer page controller
*/
class CustomerController
{
  private $model;
  private $view;
  
  function __construct()
  {
    $this->model = new CustomerModel();
    $this->view = new CustomerView();
  }
  
  public function displayReviewBillingInformation()
  {
    $customer_info = $this->model->reviewBillingInformation();	
    $this->view->reviewBillingInformation($customer_info);
  }
  
  
  public function editBillingInformation($CustomerName, $ContactName, $Address, $City, $Country, $PostalCode)
  {
    $billing_info_edited = $this->model->editBillingInformation($CustomerName, $ContactName, $Address, $City, $PostalCode, $Country);
    if ( $billing_info_edited )
    {
        $_SESSION['success_message'] = "Billing info edited!";
    }
    else
    {
        $_SESSION['error_message'] = "Failed to edit billing info!";
    }            

    $this->displayReviewBillingInformation();
  }
    
    
}
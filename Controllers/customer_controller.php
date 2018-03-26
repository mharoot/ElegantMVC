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
        public function orders()
        {
            return $this->model->getCustomerOrders();
        }
		
		public function reviewBillingInformation()
		{
			$info = $this->model->reviewBillingInformation();			
			$this->view->reviewBillingInformation($info);
		}
		
		
		public function editBillingInformation()
		{
			$info = $this->model->reviewBillingInformation();
			$this->view->editBillingInformation($info);
		}
		
		public function insertNewBillingInformation($name, $contact, $address, $city, $zip, $country)
		{
			
			$this->model->CustomerName = $name;
			$this->model->ContactName = $contact;
			$this->model->Address = $address;
			$this->model->City = $city;
			$this->model->PostalCode = $zip;
			$this->model->Country = $country;
			$this->model->where('CustomerID', '=', $_SESSION['user_id'])->save();
			header('Location: ./review-billing-information');
			
		}
		
     }
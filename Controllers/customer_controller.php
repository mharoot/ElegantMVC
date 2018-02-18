<?php

    /**
    * The Customer page controller
    */
    class CustomerController
    {
        private $modelObj;

        function __construct( $model )
        {
            $this->modelObj = $model;

        }

        public function orders()
        {
            return $this->modelObj->getCustomerOrders();
        }
		
		public function reviewBillingInformation()
		{
			return $this->modelObj->reviewBillingInformation();
		}
		
		
		public function editBillingInformation()
		{
			return $this->modelObj->reviewBillingInformation();
		}
		
		public function insertNewBillingInformation($field, $value)
		{
			return $this->modelObj->updateById($field, $value);
		}
		
     }
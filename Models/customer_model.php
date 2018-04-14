<?php
declare(strict_types=1);
class CustomerModel extends Model {
	public function __construct()  
	{  
		$this->table_name = 'customers';
		parent::__construct($this);
	}


    /**
     * Searches the customers table using foreign key = $_SESSION['user_id']
     * @return CustomerModel with all columns of that user_id or FALSE
     */
	private function getCustomer()
	{
		return $this->where('UserID', '=', $_SESSION['user_id'])
					->single();
	}


 	/**
     * Searches the customers table using foreign key = $_SESSION['user_id']
     * Update if customer exists or insert if customer does not exist
     * @return true if successfully inserted or updated Billing Information
     */
    public function editBillingInformation( $CustomerName, $ContactName, $Address, $City, $PostalCode, $Country)
    {
		$billing_info_edited = false;

		$this->CustomerName = $CustomerName;
		$this->ContactName  = $ContactName;
		$this->Address      = $Address;
		$this->City         = $City;
		$this->PostalCode   = $PostalCode;
		$this->Country      = $Country;

		$customer = $this->getCustomer();
		
        if ( $customer !== false)
        {
            // update
			$billing_info_edited = $this->where('UserID', '=', $_SESSION['user_id'])
										->save();
        }
        else
        {
            // insert		
			$this->UserID = $_SESSION['user_id'];
			$billing_info_edited = $this->save();
		}
		
		return $billing_info_edited;	
    }
	
	public function reviewBillingInformation()
	{
			//$var = $_SESSION[''];
			return $this->getCustomer();
	}
	
}
?>
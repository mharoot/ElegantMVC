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
    public function editBillingInformation($UserID, $CustomerName, $Address, $City, $PostalCode, $Country)
    {
        $customer = $this->getCustomer();
        if (isset($customer))
        {
            // get ready to update
            			$this->UserID;
			$this->CustomerName;
			$this->Address;
			$this->City;
			$this->PostalCode;
			$this->Country;
			$this->where('UserID', '=', $_SESSION['user_id'])->save();
        }
        else
        {
            // get ready to insert
			
			$this->UserID;
			$this->CustomerName;
			$this->Address;
			$this->City;
			$this->PostalCode;
			$this->Country;
			$inserted_customer = $this->save();
			
			if ($inserted_customer)
			{
				return true;
			}
			else
			{
				return false;
			}
        }
		
		
    }




















	public function create ($name, $address)
	{ 
		$this->name = $name;
		$this->address = $address;
		return $this->save();
	}
	
	public function updateById($field, $value)
	{
		
		if ($field == 'CustomerName')
		{
			$this->CustomerName = $value;
		}
		if ($field == 'ContactName')
		{
			$this->ContactName = $value;
		}
		if ($field == 'Address')
		{
			$this->Address = $value;
		}
		if ($field == 'City')
		{
			$this->City = $value;
		}
		if ($field == 'PostalCode')
		{
			$this->PostalCode = $value;
		}
		if ($field == 'Country')
		{
			$this->Country = $value;
		}
		return $this->where('CustomerID', '=', $_SESSION['user_id'])->save();
	}
	
	public function deleteCustomer($customer_id)
	{
		return $this->where('CustomerID', '=', $customer_id)->delete();
	}


	public function getCustomerOrder($customer_id)
	{
	
        $primary_key = 'CustomerID';
        $foreign_key = 'CustomerID';
        return $this->oneToMany('orders', $primary_key, $foreign_key)->where($this->table_name.'.'.$primary_key, '=', $customer_id)->get();
	}
	
	
	public function getCustomerOrders()
	{
	
        $primary_key = 'CustomerID';
        $foreign_key = 'CustomerID';
        return $this->oneToMany('orders', $primary_key, $foreign_key)->get();
	}
	
	public function reviewBillingInformation()
	{
			//$var = $_SESSION[''];
			return $this->getCustomer($_SESSION['user_id']);
	}
	
}
?>
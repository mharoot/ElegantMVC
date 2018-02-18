<?php
declare(strict_types=1);

class CustomerModel extends Model {

	//public $id; id is being autoincremented no need to set.  we need auto incremeting detection ideas
	// public $name;
	// public $address;
	/* 
		Every instance of a model should have properties like table_name, primary key, etc;
		Before the parent::__construct().
	*/
	public function __construct()  
	{  
			// by convention Elegant assumes the model representing the table in the database is all lower case and plural
			$this->table_name = 'customers';
			parent::__construct($this);

	}

	public function create ($name, $address)
	{ 
		$this->name = $name;
		$this->address = $address;
		return $this->save();
	}
	/*
	public function updateById($id,$name, $address)
	{
		$this->name = $name;
		$this->address = $address;
		return $this->where('id', '=', 5)->save();
	}
	*/
	
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
		return $this->where('CustomerID', '=', 1)->save();
	}
	
	public function deleteCustomer($customer_id)
	{
		return $this->where('CustomerID', '=', $customer_id)->delete();
	}

	public function getCustomer($customer_id)
	{
        $primary_key = 'CustomerID';
        return $this->where($primary_key, '=', $customer_id)->get();
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
			return $this->getCustomer('1');
		}


	
}

?>
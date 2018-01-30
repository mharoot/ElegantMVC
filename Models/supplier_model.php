<?php
declare(strict_types=1);
class SupplierModel extends Model 
{
	public function __construct()  
	{  
			$this->table_name = 'suppliers';
			parent::__construct($this);
	}
	
	public function getAllSuppliers()
	{
        return $this->all();
	}
}
?>
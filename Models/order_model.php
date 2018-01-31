<?php 
declare(strict_types=1);

    class OrderModel extends Model
    {

        public function __construct()
        {
            $this->table_name = "orders";
            parent::__construct($this);
        }

        public function getOrders()
        {
        	return $this->get();
        }

    }
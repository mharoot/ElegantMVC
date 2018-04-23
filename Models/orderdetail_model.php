<?php 
declare(strict_types=1);

    class OrderdetailModel extends Model
    {

        public function __construct()
        {
            $this->table_name = "orderdetails";
            parent::__construct($this);
        }


    }
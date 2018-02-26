<?php 
declare(strict_types=1);

    class CategoryModel extends Model
    {

        public function __construct()
        {
            $this->table_name = "categories";
            parent::__construct($this);
        }

        public function categories()
        {
        	return $this->get();
        }

    }
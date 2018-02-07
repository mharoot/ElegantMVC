<?php
declare(strict_types=1);

    class CategoryModel extends Model 
    {

        //private $message = 'Welcome to Home page.';

        function __construct()
        {
			$this->table_name = 'categories';
			parent::__construct($this);
        }

        public function getCategories()
        {
            return $this->all();
        }
		
		public function create($CategoryName , $Description)
		{
			$this->CategoryName = $CategoryName;
			$this->Description = $Description;
			$this->save();
		}

    }
?>
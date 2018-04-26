<?php 
declare(strict_types=1);

class ShipperModel extends Model
{

    public function __construct()
    {
        $this->table_name = "shippers";
        parent::__construct($this);
    }
}
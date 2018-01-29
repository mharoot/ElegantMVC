<?php

class PDOConnection
{
    public $connection;
    static $_instance;

    private function __construct() {
        include_once('dbconfig.php');
        $this->connection = new PDO('mysql:host='. DB_HOST .';dbname='.DB_NAME,DB_USER, DB_PASS);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function __clone(){}

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

}
?>
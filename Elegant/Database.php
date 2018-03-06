<?php
include_once('PDOConnection.php');
 ini_set('display_errors',1);
 error_reporting(E_ALL);
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
//error_reporting(E_ERROR);

class Database {


	private $connection = null;
	private $error = null;
	
	public $stmt = null;

	function __construct() 
	{
		include_once('dbconfig.php');
		
		$this->connection = PDOConnection::getInstance()->connection;
	}
	

	public function query($query){
		if($this->connection!=null)
    	$this->stmt = $this->connection->prepare($query);
		else{
			$con= $this->connectDB();
			$this->connection = $con;
			$this->stmt = $this->connection->prepare($query);
		}
		 return;
	}

	public function bind($param, $value, $type = null)
	{
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
				$type = PDO::PARAM_INT;
				break;
				case is_bool($value):
				$type = PDO::PARAM_BOOL;
				break;
				case is_null($value):
				$type = PDO::PARAM_NULL;
				break;
				default:
				$type = PDO::PARAM_STR;
				$value = strip_tags($value);
			}
		}
		
		$this->stmt->bindValue($param, $value, $type);

	}

    /* if your using CUD operationgs: only creating, updating, or deleting you just call execute */
	public function execute(){
		$result = false;
		
		if($this->stmt!=null) 
		{
            $result = $this->stmt->execute();
        }
		
		 return $result;
	}

    /*
    use if returning more than 1 row returned as an associative array
    */
	public function resultset(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function resultsetObject($className, $constructorArguments = NULL)
	{
		$this->execute();
		$this->stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $className, $constructorArguments);
		return $this->stmt->fetchAll();

	}

	public function describe($tableName)
	{
		
		$this->query("DESCRIBE ".$tableName);
		$this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_COLUMN);
	}

    /*
    use if returning only 1 row returned as an associative array
    */
	public function single(){
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}

    /*
    can use for 1 or more returned as an array
    */
	public function fetchObj(){
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_OBJ);
	}
	
	public function rowCount(){
		return $this->stmt->rowCount();
	}

	public function lastInsertId(){
		return $this->connection->lastInsertId();
	}

}
?>
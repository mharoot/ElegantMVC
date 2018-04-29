<?php

include_once("Database.php");
include_once("QueryBuilder.php");
class Model extends Database 
{
    private $queryBuilder = NULL;
    private $child_class  = NULL;
    public $table_name = NULL;
    private $child_class_cols = [];
    private $whereColValBindStack = [];
    private $hasWhereClause; // model uses this for binding.
    private $INIT_CHILD_CLASS_TO_NULL = '!E@L#E$G%A^N&T*O(R)M';
    private $dup_col_names = [];

    function __construct($child_class = NULL) 
    {
        $child_class_that_called_model = '';
        if ($this->table_name === NULL )
        {
            $child_class_that_called_model = get_class($child_class);
            $snake_case = $child_class_that_called_model.'s';
            $this->table_name = strtolower($snake_case);
        }

        $this->queryBuilder = new QueryBuilder($this->table_name);
        $this->child_class = $child_class;
        parent::__construct();
        $this->checkTableExist($this->table_name);
        
        $table_cols = $this->describe($this->table_name);

        //dynamically creating child class properties in construct
        foreach ($table_cols as $col)
        {
            $this->child_class->{$col} = $this->INIT_CHILD_CLASS_TO_NULL;
            array_push($this->child_class_cols, $col);
        }

    }

    public function save() // returns boolean
    {
        $result = FALSE;
        if (!$this->hasWhereClause) 
        {
            $result = $this->insert($this->getChildProps());
        } 
        else 
        {
            $result = $this->update($this->getChildProps());
            $this->dup_col_names  = [];
            $this->whereColValBindStack = [];
        }
        return $result;
    }

    public function getChildProps()
    {

        $child_props = [];

        // CHILD CLASS
        $class_name = get_class($this->child_class);
        $class_vars = get_class_vars($class_name);
        $object_vars  = get_object_vars($this->child_class);
        
        foreach ($this->child_class_cols as $index => $property_name) 
        {            
            if( $object_vars[$property_name] !== $this->INIT_CHILD_CLASS_TO_NULL )
                $child_props[$property_name] = $object_vars[$property_name];
        }


        return $child_props;
    }

    public function all() 
    {        
        $q = $this->queryBuilder->all();
        $this->query($q);
        $class_name = get_class($this->child_class);
        $results = $this->resultsetObject($class_name);

        return $results;
    }

    private function bindWhereConditions()
    {
        while (sizeof($this->whereColValBindStack))
        {
            $col_val = array_pop($this->whereColValBindStack);
            $this->bind(':'.$col_val[0], $col_val[1]);
        }
    }

    public function get($cols = NULL)
    {
        $q = $this->queryBuilder->get($cols);
        $this->query($q);
        $this->bindWhereConditions();
        $class_name = get_class($this->child_class);
        $results    = $this->resultsetObject($class_name);
        $this->hasWhereClause = false;
        $this->dup_col_names  = [];
        $this->whereColValBindStack = [];

        return $results;
    }


    public function single($cols = NULL) 
    {
        $result = $this->get($cols);
        if (count($result) > 0)
        {
            return $result[0];
        }
        else
            return false;
    }


    public function delete()
    {
        $q = $this->queryBuilder->delete();
        if ($q == '')
        {
             //redirect('error404.php');
            return false;
        }
        $this->query($q);
        $this->bindWhereConditions();
        $this->dup_col_names  = [];
        $this->whereColValBindStack = [];
        return $this->execute();
    }


    private function update($col_val_pairs)
    {
        $q = $this->queryBuilder->update($col_val_pairs);
        if ($q == '')
        {
             //redirect('error404.php');
            return false;
        }
       
        // prepare the query before binding
        $this->query($q);
        reset($col_val_pairs);

        // PDO security of update
        while ( list( $key, $val ) = each( $col_val_pairs ) ) 
        {
            $this->bind(':'.$key, $val);
        }

        $this->bindWhereConditions();

        

        return $this->execute();
    }

    private function insert($col_val_pairs)
    {
        $q = $this->queryBuilder->insert($col_val_pairs);
        if ($q == '')
        {
             // redirect('error404.php');
            return false;
        }

        // prepare the query before binding
        $this->query($q);
        reset($col_val_pairs);
        // PDO security of insert
        while ( list( $key, $val ) = each( $col_val_pairs ) ) 
        {
            $this->bind(':'.$key, $val);
        }
                
        return $this->execute();
    }


    public function where ($col_name, $arg2, $arg3 )
    {
        
        $this->queryBuilder->where($col_name, $arg2);
        $col_name = $this->dup_col_name_checker($col_name);  
        
        
        // lets build a stack of where col arg val statements so we can pop and bind clean sanitized input
        array_push($this->whereColValBindStack, [$col_name, $arg3]);

        // after update delete or get is called we pop the stack till its empty binding the parameters  array_pop($stack);
       
        // this will go in update, delete, and get 
        // array_pop($this->whereColValBindStack)
        // $this->bind(':'.$col_name, $arg3);
        $this->hasWhereClause = TRUE;

        return $this;
    }
  
/**
 * @filterTableNames: Assumes all expressions from within a child class are on the primary table.
 * For example, $this->oneToMany('orders', $primary_key, $foreign_key)
 *                   ->where($this->table_name.'.'.$primary_key, '=', $customer_id)
 *                   ->get();
 * 
 * @Todo: 
 * Change the assumption for any table.
 * For example, $this->oneToMany('orders', $primary_key, $foreign_key)
 *                   ->where(any_table_name.'.'.$primary_key, '=', $customer_id)
 *                   ->get();
 * 
 * @param $table_col_name : primary table
 * 
 * 
 * 
 */
  
private function filterTableName($table_col_name)
{   
    $filter = FALSE;
    $m = 0;
    $n = strlen($table_col_name);
    for ($i = 0; $i < $n; $i++)//$m; $i++)
    {
        if ( substr($table_col_name, $i, 1) === '.' )// substr($table, $i, 1) )
        {            
            $filter = TRUE;
            $m = $i + 1;
        }
    }

    if ($filter)
    {
        $table_col_name = substr($table_col_name, $m, $n);
    }

    return $table_col_name;

}






    public function orWhere ($col_name, $arg2, $arg3 ) 
    {
        $this->queryBuilder->orWhere($col_name, $arg2);
        $col_name = $this->dup_col_name_checker($col_name);        
        array_push($this->whereColValBindStack, [$col_name, $arg3]);
        $this->hasWhereClause = TRUE;
        return $this;
    }
    private function dup_col_name_checker($col_name) {
        $col_name = $this->filterTableName($col_name);

        // duplicate bind name checker.
        if (isset($this->dup_col_names[$col_name]))
        {
            for ($i = 1; $i < 100; $i++)
            {
                if ( isset($this->dup_col_names[$col_name]) )
                {
                    $this->dup_col_names[$col_name] = true;
                    $col_name = $col_name."_$i";
                    return $col_name;
                }
            }

        }
        else {
        $this->dup_col_names[$col_name] = true;
        }
        return $col_name;
    }




	public function manyToMany($table_name,$junction_table,$this_primary_key,$primary_key) 
    {
        $this->checkTableExist($table_name);
        $this->checkTableExist($junction_table);
        $this->addRelationProperties($junction_table);
        $this->queryBuilder->manyToMany($table_name,$junction_table,$this_primary_key,$primary_key);
        return $this;
    }
	


    public function oneToOne($table_name, $primary_key, $foreign_key) 
    { 
        $this->checkTableExist($table_name);
        $this->addRelationProperties($table_name);
        $this->queryBuilder->oneToOne($table_name, $primary_key, $foreign_key);
        return $this;
    }


    public function oneToMany($table_name, $primary_key, $foreign_key) 
    { 
        $this->checkTableExist($table_name);
        $this->addRelationProperties($table_name);
        $this->queryBuilder->oneToMany($table_name, $primary_key, $foreign_key);
        return $this;
    }

    private function addRelationProperties($related_table_name)
    {
          // RELATED CLASS
          if ($related_table_name !== FALSE)
          {
              
              $table_cols = $this->describe($related_table_name);
              //dynamically creating child class properties in for joined class.
              foreach ($table_cols as $col)
              {
                  $this->child_class->{$col} = NULL;
                  array_push($this->child_class_cols, $col);
              }
          }
    }

    public function join($ft)
    {
        $this->queryBuilder->join($ft);
        return $this;
    }

    public function innerJoin($ft)
    {
        $this->queryBuilder->innerJoin($ft);
        return $this;
    }

    public function leftJoin($ft)
    {
        $this->queryBuilder->leftJoin($ft);
        return $this;
    }

     public function rightJoin($ft)
    {
        $this->queryBuilder->rightJoin($ft);
        return $this;
    }

     public function fullJoin( $ft, $pk, $op, $fk)
    {
        $this->queryBuilder->fullJoin( $ft, $pk, $op, $fk);
        return $this;
    }

    public function crossJoin($ft)
    {
        $this->queryBuilder->crossJoin($ft);
        return $this;
    }

    public function on($pk, $op, $fk)
    {
        $this->queryBuilder->on($pk, $op, $fk);
        return $this;
    }



    private function setErrorMessage($m)
    {
        session_start();
        $_SESSION['error_message'] = $m;
        session_write_close();
    }

    public function limit($offset,$row_count)
    {
        $this->queryBuilder->limit($offset, $row_count);
        return $this;
    }

    public function orderBy($col, $desc = false)
    {
        $this->queryBuilder->orderBy($col, $desc);
        return $this;
    }

    public function paginate($row_count)
    {
        $items = $this->get();
        $total = count($items);
        $arr = [];
        $j = 1;
        $k = 0;
        for ($i=0; $i < $total; $i++) {
            if($k < $row_count){ 
                $arr[$j][$k] = $items[$i];
            }else{
                $k = 0;
                $j = $j + 1;
                $arr[$j][$k] = $items[$i];
            }
            $k++;
        }
        $arr['last_page'] = $j;
        return $arr;
        
    }


   








    /*************************************************************************
     *                         UTILITY FUNCTIONS
     *************************************************************************/

    private function checkTableExist ($table_name = NULL) 
    { 
        // check if developer remembered to give table name
        if ($this->table_name === NULL)
        {
            $this->redirect('error404.php');
        }

        // check if (this table) or (the table we are trying to join) name is correct or 
        $tableExists = $this->checkTableExistHelper($table_name);
        if (!$tableExists)
        {
            $this->redirect('error404.php');
        }
    }






    private function checkTableExistHelper ($table_name) 
    {

        if ($table_name == NULL) 
        {
            // then we are checking for the existence of this models table
            $this->query("SHOW TABLES LIKE '".$this->table_name."'");
        } 
        else 
        {
            // we are checking for the table we are trying to join
            $this->query("SHOW TABLES LIKE '".$table_name."'");
        }

        $result = $this->execute();

        return $this->rowCount($result) > 0;
    }





    private function redirect ($url) 
    {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }
}

?>
<?php
declare(strict_types=1);
/*
    TODO:
    NOTE: GET(), UPDATE(), DELETE(), INSERT()
    1. All return strings so these
    2. All must reset the query string because its the end of the query.
*/
class QueryBuilder 
{


    private $hasSelect;
    private $hasWhereClause; // model uses this for binding. Anything public in query builder from now on 
    private $isManyToMany;
    private $isOneToOne;
    private $isOneToMany;
    private $query;
    private $table_name;
    private $tableNames = [];
    private $dup_col_names = [];





    function __construct ($models_table_name) 
    {
        $this->resetProperties();
        $this->table_name = $models_table_name;
    }
    





    public function all() 
    {
        return 'SELECT * FROM '.$this->table_name;
       
    }
 
/*
// delete ------  http://dev.mysql.com/doc/refman/5.6/en/delete.html  ------------------------
delete_statements:
	DELETE_SYM (LOW_PRIORITY)? (QUICK)? (IGNORE_SYM)?
	( delete_single_table_statement | delete_multiple_table_statement1 | delete_multiple_table_statement2 )
;
delete_single_table_statement:
	FROM table_spec
	(partition_clause)?
	(where_clause)?
	(orderby_clause)?
	(limit_clause)?
;
delete_multiple_table_statement1:
	table_spec (ALL_FIELDS)? (COMMA table_spec (ALL_FIELDS)?)*
	FROM table_references
	(where_clause)?
;
delete_multiple_table_statement2:
	FROM table_spec (ALL_FIELDS)? (COMMA table_spec (ALL_FIELDS)?)*
	USING_SYM table_references
	(where_clause)?
;
*/
    public function delete()
    {
        if (!$this->hasWhereClause)
        {
            return '';
        }

        $query ="DELETE FROM ".$this->table_name;
 
        if ($this->isOneToMany || $this->isOneToOne)
        {
            /*
                DELETE books, genres 
                FROM books 
                LEFT JOIN genres 
                ON books.genre_id=genres.genre_id 
                WHERE genres.genre_id = 1
            */
            $query = "DELETE ";
            $query.= array_pop($this->tableNames).', ';
            $query.= array_pop($this->tableNames).' FROM ';
        }

        if ($this->isManyToMany)
        {
            //DELETE customers, orders FROM (customers JOIN orders ON customers.CustomerID=orders.CustomerID) WHERE customers.CustomerID = 90
            // assuming order of table names does not matter
            
            $query = "DELETE ";
            $query.= array_pop($this->tableNames).', ';
            $query.= array_pop($this->tableNames).' FROM ';
        }
        
 
        $query .= $this->query;
        $this->resetProperties();
        return $query;
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



/*
// insert ---------  http://dev.mysql.com/doc/refman/5.6/en/insert.html  -------------------------
insert_statements :
	insert_statement1 | insert_statement2 | insert_statement3
;

insert_header:
	INSERT (LOW_PRIORITY | HIGH_PRIORITY)? (IGNORE_SYM)?
	(INTO)? table_spec 
	(partition_clause)?
;

insert_subfix:
	ON DUPLICATE_SYM KEY_SYM UPDATE column_spec EQ_SYM expression (COMMA column_spec EQ_SYM expression)*
;

insert_statement1:
	insert_header
	(column_list)? 
	value_list_clause
	( insert_subfix )?
;
value_list_clause:	(VALUES | VALUE_SYM) column_value_list (COMMA column_value_list)*;
column_value_list:	LPAREN (bit_expr|DEFAULT) (COMMA (bit_expr|DEFAULT) )* RPAREN ;

insert_statement2:
	insert_header
	set_columns_cluase
	( insert_subfix )?
;
set_columns_cluase:	SET_SYM set_column_cluase ( COMMA set_column_cluase )*;
set_column_cluase:	column_spec EQ_SYM (expression|DEFAULT) ;

insert_statement3:
	insert_header
	(column_list)? 
	select_expression
	( insert_subfix )?
;
*/
    public function insert($col_val_pairs)
    {

        /*
            INSERT INTO table_name ( field1, field2,...fieldN ) VALUES ( value1, value2,...valueN );
        */
        reset($col_val_pairs);
        $query ="INSERT INTO ".$this->table_name." (";
        
        
        $prefix = '';
        $n = sizeof($col_val_pairs) - 1;
        $i = 0;
        while ( list( $key, $val ) = each( $col_val_pairs ) ) 
        {
            $query .= " ".$prefix.$key;
            if($i != $n)
            {
                $i++;
                $query .= ",";
            }

        }
        $query .= " ) VALUES (";
        

        reset($col_val_pairs);
        $i = 0;
        while ( list( $key, $val ) = each( $col_val_pairs ) ) 
        {
            $query .= " :".$key;  // 'INSERT INTO users (user_type, first_name, last_name) VALUES (:user_type, :first_name, :last_name)'
            if($i != $n)
            {
                $i++;
                $query .= ",";
            }

        }
        $query .= " )";
        $this->resetProperties();
        return $query;
    }

/*
select ------  http://dev.mysql.com/doc/refman/5.6/en/select.html  -------------------------------
select_statement:
        select_expression ( (UNION_SYM (ALL)?) select_expression )* 
;

select_expression:
	SELECT 
	
	( ALL | DISTINCT | DISTINCTROW )? 
	(HIGH_PRIORITY)?
	(STRAIGHT_JOIN)?
	(SQL_SMALL_RESULT)? (SQL_BIG_RESULT)? (SQL_BUFFER_RESULT)?
	(SQL_CACHE_SYM | SQL_NO_CACHE_SYM)? (SQL_CALC_FOUND_ROWS)?

	select_list
	
	( 
		FROM table_references 
		( partition_clause )?
		( where_clause )? 
		( groupby_clause )?
		( having_clause )?
	) ?
	
	( orderby_clause )?
	( limit_clause )?
	( ( FOR_SYM UPDATE) | (LOCK IN_SYM SHARE_SYM MODE_SYM) )? 
;
*/
    public function select ($cols = NULL)
    {
        $this->query = 'SELECT ';

        if ($cols == null) 
        {
            // we have not specified what columns we want to retrieve, so we assume all is wanted
            $this->query .= "*";
        }
        else // we have specified what columns we want to retrieve
        {   

            $length = sizeof($cols) -1;

            for ($i = 0; $i < $length; $i++) 
            {
                $this->query.= $cols[$i] . ", ";
            }

            $this->query.= $cols[$length];
        }
        $this->query.= " FROM ".$this->table_name;

        return $this;
    }

/*
// update --------  http://dev.mysql.com/doc/refman/5.6/en/update.html  ------------------------
update_statements :
single_table_update_statement | multiple_table_update_statement
;

single_table_update_statement: 
UPDATE (LOW_PRIORITY)? (IGNORE_SYM)? table_reference
set_columns_cluase
(where_clause)?
(orderby_clause)?
(limit_clause)?
;

multiple_table_update_statement: 
UPDATE (LOW_PRIORITY)? (IGNORE_SYM)? table_references
set_columns_cluase
(where_clause)?
;
*/
    public function update($col_val_pairs)
    {
        if (!$this->hasWhereClause)
        {
            return '';
        }

        /*
        $query_update = $this->prepare('');
        
        to do:
        1. update query builder insert
        2. update query builder update
        3. update model insert  (do binding in here)
        4. update model update  (do binding in here)
        
        UPDATE users SET user_password_hash = :user_password_hash WHERE user_id = :user_id


        $query_update->bindValue(:user_password_hash', $user_password_hash, PDO::PARAM_STR);
        $query_update->bindValue(:user_id', $result_row->user_id, PDO::PARAM_INT);
        
        
        
        $query_update->execute();
        */
        reset($col_val_pairs);
        $pos = strpos($this->query, ' WHERE');
        $query = 'UPDATE';
        if ($this->isOneToMany)
        {
            // multi table updates up to 2 at a time for relationships
            //$query .= $this->query;
            $sub_str_relation = substr($this->query, 0, $pos); // " (orders LEFT JOIN orderdetails ON orders.OrderID=orderdetails.OrderID) "
            $query .= $sub_str_relation."SET";

        } 
        else
        {
            // single table updates
            $query .= ' '.$this->table_name." SET"; // "UPDATE books SET"
        }

        
        $prefix = '';
        $n = sizeof($col_val_pairs) - 1;
        $i = 0;
        while ( list( $key, $val ) = each( $col_val_pairs ) ) 
        {
            $query .= " ".$prefix.$key." = ".":".$prefix.$key; // "UPDATE books SET title = :title
            if($i != $n)
            {
                $i++;
                $query .= ","; // "UPDATE books SET title = :title, description = :description"
            }

        }
        reset($col_val_pairs);
        $i = 0;

        if ( !$this->isOneToOne && !$this->isOneToMany && !$this->isManyToMany )
        {
            $query .= $this->query;
        }
        else
        {
            $append_where = substr($this->query, $pos, strlen($this->query)); 
            $query .=$append_where;
        }
        
        $this->resetProperties();
        return $query;
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
   /**
    * 
    *  About Where:
    *  It prepares model for binding sanitized input.  You cannot pass in a WHERE
    *  clause in a safe fashion period end of story. Prepare for all possible user input.
    *
    *  Assumption:
    *      The where function was built assuming only there can be only one WHERE clause in an sql query.
    *
    *  @param string $col_name is use to prepare :$col_name for binding
    *  @param string $arg2 = {=,>,<,<=,>=,LIKE}
    * 
    */
    public function where ( $col_name, $arg2 )
    {
        // Developers may pass for example tableName.id
        $col_table_name = $col_name;
        $col_name = $this->dup_col_name_checker($col_name);


        
        if ( ! $this->hasWhereClause ) // where has not been called already
        {   // then add WHERE

            if ($this->query == '') // the query string is not filled
            {   //then prepare for a call to delete or update to append to front of the query string


                // " WHERE USERNAME=:username "
                //              WHERE    USERNAME   =     :   username 
                $this->query =" WHERE ".$col_table_name .$arg2.":".$col_name." ";
            }
            else
            {
                $this->query .=" WHERE ".$col_table_name .$arg2.":".$col_name." ";
            }
        } 
        else 
        {
            // " WHERE USERNAME=:username AND PASSWORD=:pass"
            //                AND    PASSWORD   =     :  pass
             $this->query .=" AND ".$col_table_name .$arg2.":".$col_name." ";
        }

        $this->hasWhereClause = TRUE;

        return $this;
    }






    public function orWhere ( $col_name, $arg2)
    {
        $col_table_name = $col_name;
        $col_name = $this->dup_col_name_checker($col_name);
        
        if ( ! $this->hasWhereClause ) 
        {
            if ($this->query == '')
            {
                $this->query =" WHERE ".$col_table_name .$arg2.":".$col_name." ";
            }
            else
            {
                $this->query .=" WHERE ".$col_table_name .$arg2.":".$col_name." ";
            }
        } 
        else 
        {
             $this->query .=" OR ".$col_table_name .$arg2.":".$col_name." ";
        }

        $this->hasWhereClause = TRUE;

        return $this;
    }






	public function manyToMany ( $table_name, $junction_table, $this_primary_key, $primary_key) 
    {
        /*SELECT * from books INNER JOIN books_authors ON (books.book_id=books_authors.book_id) INNER JOIN authors ON (books_authors.author_id = authors.author_id) where 1*/

        // the assumption here is that for delete, updates were doing a hasMany side
        // the developer should know that it deletes, updates, and inserts into the junction table only
        // to insert into table_name the developer needs to access it from within table_name's model. or we may even build the inverse oneToMany function.
        array_push($this->tableNames, $this->table_name);
        array_push($this->tableNames, $junction_table);

        $this->isManyToMany = TRUE;

        if($this->query == '')
        {
            $this->query = $this->table_name." JOIN ".$junction_table." ON ".$this->table_name.".".$this_primary_key."=".$junction_table.".".$this_primary_key." JOIN ". $table_name." ON ".$junction_table.".".$primary_key."=".$table_name.".".$primary_key;
        }
        else
        {
             $this->query .= " JOIN ".$junction_table." ON ".$this->table_name.".".$this_primary_key."=".$junction_table.".".$this_primary_key." JOIN ". $table_name." ON ".$junction_table.".".$primary_key."=".$table_name.".".$primary_key;
        }

        return $this;
    }
	





    public function oneToOne ( $table_name, $primary_key, $foreign_key) 
    { 
        $this->isOneToOne = TRUE;
        // void function will be part of query building


        /* SELECT * FROM books JOIN genres ON books.genre_id=genres.id */
        $this->query = $this->table_name." LEFT JOIN ".$table_name." ON ".$this->table_name.".".$primary_key."=".$table_name.".".$foreign_key;
        
        array_push($this->tableNames, $this->table_name);
        array_push($this->tableNames, $table_name);

        return $this;
    }

    public function oneToMany($table_name, $primary_key, $foreign_key) { 
        $this->isOneToMany = TRUE;
        // void function will be part of query building
        array_push($this->tableNames, $this->table_name);
        array_push($this->tableNames, $table_name);

        // In practical applications, a shipper many want to view a customer's orders and information in a single page. 
        // In the case that customer does not have any orders placed you may want to still display that customers information 
        // rather than returning null if that customer has not placed any orders.
        // Using a LEFT JOIN is more optimal since you only need to make 1 query rather than 2.  It will save users of elegant
        // the headache of writing additional code.
        $this->query = " ".$this->table_name." RIGHT JOIN ".$table_name." ON ".$this->table_name.".".$primary_key."=".$table_name.".".$foreign_key." ";
        return $this;
        
    }

    public function get ($cols = NULL)
    {
        $final_query = 'SELECT ';

        if ($cols == null) // we have not specified what columns we want to retrieve, so we assume all is wanted
        {
            // if we have called any relationship function
            if ($this->isOneToOne || $this->isOneToMany || $this->isManyToMany)
            {
                // SELECT * FROM
                $final_query .= "* FROM "; 
            }
            else
            {
                // SELECT * FROM table_name
                $final_query .= "* FROM ".$this->table_name;
            }
            
                
        } 
        else // we have specified what columns we want to retrieve
        {   

            $length = sizeof($cols) -1;

            for ($i = 0; $i < $length; $i++) 
            {
                $final_query .= $cols[$i] . ", ";
            }

            $final_query .= $cols[$length];
            // At this point we have one or more columns we specified
            // SELECT col1, col2, ...., colk

            if ($this->isOneToOne || $this->isOneToMany|| $this->isManyToMany)
            {
                // SELECT col1, col2, ...., colk FROM 
                $final_query .= " FROM ";
            }
            else
            {
                // SELECT col1, col2, ...., colk FROM table_name
                $final_query .= " FROM ".$this->table_name;
            }
        }

        /**
         * Code Tracing Note: 
         * At this point we have not touched the property $this->query within this function get.
         * However, if one or more functions that build the query statement have been called.
        */

        if ($this->query !== '') // get has been called after one or more functions that build the query
        {
            $final_query .= $this->query;
            $this->resetProperties();
        }  
        else // get has been called all by itself
        {
            $this->resetProperties();
        }
        return $final_query;
        
    }

    public function join($ft)
    {
        $this->query .= " JOIN (". $ft ;
        return $this;
    }
    
    public function innerJoin($ft)
    {
        $this->query .= " INNER JOIN (". $ft ;
        return $this;
    }

    public function leftJoin($ft)
    {
        $this->query .= " LEFT JOIN (". $ft ;
        return $this;
    }
    public function rightJoin($ft)
    {
        $this->query .= " RIGHT JOIN (". $ft ;
        return $this;
    }


    public function fullJoin ( $ft, $pk, $op, $fk)
    {
        /*
            SELECT * FROM t1 -> this happens in get and will be preprended to query string.
            LEFT JOIN t2 ON t1.id=t2.id 
            UNION SELECT * FROM t1 RIGHT JOIN t2 ON t1.id=t2.id
        */
        $this->query .= " LEFT JOIN ".$ft." ON ".$pk.$op.$fk.
                        " UNION SELECT * FROM ".$this->table_name." RIGHT JOIN ".$ft." ON ".$pk.$op.$fk;
        return $this;
    }

    public function crossJoin($ft)
    {
        $is_appended = FALSE;

        if ($this->hasSelect)


        /* accomadate crossJoin->get chain calls */
        $this->query = " CROSS JOIN ".$ft;

        /* accomadate select->crossJoin->get chain calls */
        $this->query .= " CROSS JOIN ".$ft;


        return $this;
    }

    public function on($pk,$op,$fk)
    {
        $this->query .= ") ON ". $pk ." ".$op ." ". $fk;
        return $this;
    }

    public function limit($offset, $row_count)
    {
        $this->query.= " LIMIT ".$offset.",".$row_count;
        return $this;
    }


    public function orderBy($col, $desc = FALSE)
    {
        if($desc == TRUE)
        {
            $this->query.= " ORDER BY ".$col. " DESC"; 
        }else{
            $this->query.= " ORDER BY ".$col. " ASC";
        }
        
        return $this;
    }


    /**
     * Resets all but the table name properties.
     *
     */
    private function resetProperties()
    {

        $this->hasWhereClause = FALSE;
        $this->isManyToMany   = FALSE;
        $this->isOneToOne     = FALSE;
        $this->isOneToMany    = FALSE;
        $this->dup_col_names  = [];
        $this->query          = '';
    }


}

?>
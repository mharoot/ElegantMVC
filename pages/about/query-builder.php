<div style="background-color:#fff"  class="jumbotron">
<article>

<h1>Elegant Models: Built in Database Query Builder</h1>
<ul>
    <li><a href="#introduction">Introduction</a></li>
    <li>
        <a href="#retrieving-results">Retrieving Results</a>
        <ul>
            <li><a href="#retrieving-all-rows-from-a-table">Retrieving All Rows From A Table</a></li>
        </ul>
    </li>
    <li><a href="#selects">Selects</a></li>
    <li>
        <a href="#relations">Relations</a>
        <ul>
            <li><a href="#many-to-many">Many to Many</a></li>
            <li><a href="#one-to-many">One to Many</a></li>
            <li><a href="#one-to-one">One to One</a></li>
        </ul>
    </li>
    <li>
        <a href="#where-clauses">Where Clauses</a>
        <ul>
            <li><a href="#simple-where-clauses">Simple Where Clauses</a></li>
            <li><a href="#and-statements">And Statements</a></li>
            <li><a href="#or-statements">Or Statements</a></li>
        </ul>
    </li>
     <li>
        <a href="#join-clauses">Join Clauses</a>
        <ul>
            <li><a href="#inner-join-clauses">Join and Inner Join </a></li>
            <li><a href="#left-right-join-clauses">Left Join and Right Join </a></li>
            <li><a href="#full-join-clauses">Full Join </a></li>
            <li><a href="#cross-join-clauses">Cross Join </a></li>
        </ul>
    </li>
    <li>
        <a href="#paginate">Pagination</a>
    </li>
</ul>


<!-- Introduction -->
<p><a name="introduction"></a></p>
<h2><a href="#introduction">Introduction</a></h2>
<p>Elegant models have a built in database query builder that provides a convenient, fluent interface to creating and running database queries within models. It can be used to perform most database operations in your application and works on all supported database systems.</p>
<p>The Elegant query builder uses PDO parameter binding to protect your application against SQL injection attacks. There is no need to clean strings being passed as bindings.</p>
<!-- END OF Introduction -->





<!-- Retrieving Results -->
<p><a name="retrieving-results"></a></p>
<h2><a href="#retrieving-results">Retrieving Results</a></h2>

<p><a name="retrieving-all-rows-from-a-table"></a></p>
<h4>Retrieving All Rows From A Table</h4>
<p>You may use the <code class="language-php">all</code> method in order to request all rows and all columns within a <code class="language-php">Model</code>'s database table. The <code class="language-php">all</code> method in <code class="language-php">QueryBuilder</code> returns a proper query string for the <code class="language-php">Model</code> to execute the query.



<pre class="language-php"><p><code class="CodeFlask__code language-php"><span class="token variable">$books</span> <span class="token operator">=</span> <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">all</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
</code></p></pre>    




<!-- END OF Retrieving Results -->





<!-- SELECTS -->
<p><a name="selects"></a></p>
<h2><a href="#selects">Selects</a></h2>
<h4>Specifying A Select Clause within <code>Get Parameter</code></h4>
<p>Of course, you may not always want to select all columns from a database table. You can specify what columns you want in the <code>get()</code> method as done in the following code snippet below:</p>

<pre class="language-php"><p><code class="CodeFlask__code language-php"><span class="token variable">$books</span> <span class="token operator">=</span> <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token keyword">array</span><span class="token punctuation">(</span><span class="token string">'author_name'</span><span class="token punctuation">,</span> <span class="token string">'description'</span><span class="token punctuation">,</span> <span class="token string">'title'</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
</code></p></pre>    


<!-- END OF SELECTS -->




<!-- RELATIONS -->
<p><a name="relations"></a></p>
<h2><a href="#relations">Relations</a></h2>

<p><a name="many-to-many"></a></p>
<h4>Many To Many</h4>
<p>Many-to-many relations are slightly more complicated than <code class=" language-php">oneToOne</code> and <code class=" language-php">oneToMany</code> relationships. An example of such a relationship is a book with many authors, where the authors are also shared by other books. For example, many books may have the author of "Stephen King". To define this relationship, three database tables are needed: <code class=" language-php">books</code>, <code class=" language-php">authors</code>, and <code class=" language-php">author_book</code>. The <code class=" language-php">author_book</code> table is derived from the alphabetical order of the related model names, and contains the <code class=" language-php">book_id</code> and <code class=" language-php">author_id</code> columns.</p>



<pre class="language-php"><p><code class="CodeFlask__code language-php"><span class="token delimiter important">&lt;?php</span>
<span class="token keyword">include_once</span><span class="token punctuation">(</span><span class="token string">"Elegant/Model.php"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token keyword">class</span> <span class="token class-name">Book</span> <span class="token keyword">extends</span> <span class="token class-name">Model</span> <span class="token punctuation">{</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">__construct</span><span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>  
        <span class="token keyword">parent</span><span class="token punctuation">:</span><span class="token punctuation">:</span><span class="token function">__construct</span><span class="token punctuation">(</span><span class="token variable">$this</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>

    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">getBooksAuthors</span><span class="token punctuation">(</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token variable">$foreign_table_name</span>        <span class="token operator">=</span> <span class="token string">'authors'</span><span class="token punctuation">;</span>
        <span class="token variable">$foreign_table_primary_key</span> <span class="token operator">=</span> <span class="token string">'author_id'</span><span class="token punctuation">;</span>
        <span class="token variable">$junction_table_name</span>       <span class="token operator">=</span> <span class="token string">'books_authors'</span><span class="token punctuation">;</span>
        <span class="token variable">$primary_table_name</span>        <span class="token operator">=</span> <span class="token string">'books'</span><span class="token punctuation">;</span>
        <span class="token variable">$primary_table_primary_key</span> <span class="token operator">=</span> <span class="token string">'book_id'</span><span class="token punctuation">;</span>
        
        <span class="token keyword">return</span> <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">manyToMany</span><span class="token punctuation">(</span> <span class="token variable">$foreign_table_name</span><span class="token punctuation">,</span> <span class="token variable">$junction_table_name</span><span class="token punctuation">,</span> 
                            <span class="token variable">$foreign_table_primary_key</span><span class="token punctuation">,</span> <span class="token variable">$foreign_table_primary_key</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>

<span class="token punctuation">}</span>
<span class="token delimiter important">?&gt;</span>
</code></p></pre>



<p><a name="one-to-many"></a></p>
<h4>One To Many</h4>
<p>A "one-to-many" relationship is used to define relationships where a single model owns any amount of other models. For example, a customer may have placed many orders. Like all other Elegant relationships, one-to-many relationships are defined by placing a function on your Elegant model:</p>


<pre class="language-php"><p><code class="CodeFlask__code language-php"><span class="token delimiter important">&lt;?php</span>
<span class="token keyword">include_once</span><span class="token punctuation">(</span><span class="token string">"Elegant/Model.php"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token keyword">class</span> <span class="token class-name">Customer</span> <span class="token keyword">extends</span> <span class="token class-name">Model</span> <span class="token punctuation">{</span>
	<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">__construct</span><span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
            <span class="token keyword">parent</span><span class="token punctuation">:</span><span class="token punctuation">:</span><span class="token function">__construct</span><span class="token punctuation">(</span><span class="token variable">$this</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
	<span class="token punctuation">}</span>

	<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">getOrders</span><span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
            <span class="token variable">$foreign_table</span> <span class="token operator">=</span> <span class="token string">'orders'</span><span class="token punctuation">;</span>
            <span class="token variable">$primary_key</span>   <span class="token operator">=</span> <span class="token string">'id'</span><span class="token punctuation">;</span>
            <span class="token variable">$foreign_key</span>   <span class="token operator">=</span> <span class="token string">'customer_id'</span><span class="token punctuation">;</span>
            <span class="token comment" spellcheck="true">/**
             *  Get the orders associated with the customer.
             */</span>
            <span class="token keyword">return</span> <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">oneToMany</span><span class="token punctuation">(</span><span class="token variable">$foreign_table</span><span class="token punctuation">,</span> <span class="token variable">$primary_key</span><span class="token punctuation">,</span> <span class="token variable">$foreign_key</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
        <span class="token punctuation">}</span>
<span class="token punctuation">}</span>
<span class="token delimiter important">?&gt;</span>
</code></p></pre>



<p><a name="one-to-one"></a></p>
<h4>One To One</h4>
<p>A one-to-one relationship is a very basic relation. For example, a <code class=" language-php">Book</code> model might be associated with one <code class=" language-php">Genre</code>. To define this relationship, we place a <code class=" language-php">genre</code> method on the <code class=" language-php">Book</code> model. The <code class=" language-php">genre</code> method should call the <code class=" language-php">oneToOne</code> method and return its result:</p>

<pre class="language-php" style="top: 0px;"><p><code class="CodeFlask__code language-php"><span class="token php language-php"><span class="token delimiter important">&lt;?php</span>
<span class="token keyword">include_once</span><span class="token punctuation">(</span><span class="token string">"Elegant/Model.php"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token keyword">class</span> <span class="token class-name">Book</span> <span class="token keyword">extends</span> <span class="token class-name">Model</span> <span class="token punctuation">{</span>
	<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">__construct</span><span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
            <span class="token keyword">parent</span><span class="token punctuation">:</span><span class="token punctuation">:</span><span class="token function">__construct</span><span class="token punctuation">(</span><span class="token variable">$this</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
	<span class="token punctuation">}</span>

	<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">genre</span><span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
            <span class="token comment" spellcheck="true">/**
             * Get the genre associated with the book.
             */</span>
            <span class="token keyword">return</span> <span class="token variable">$result</span> <span class="token operator">=</span> <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">oneToOne</span><span class="token punctuation">(</span><span class="token string">'genres'</span><span class="token punctuation">,</span><span class="token string">'genre_id'</span><span class="token punctuation">,</span><span class="token string">'id'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>   
	<span class="token punctuation">}</span>
<span class="token punctuation">}</span>
</span></code></p></pre>

<!-- END OF RELATIONS -->




<!-- WHERE CLAUSES -->
<p><a name="where-clauses"></a></p>
<h2><a href="#where-clauses">Where Clauses</a></h2>

<p><a name="simple-where-clauses"></a></p>
<h4>Simple Where Clauses</h4>
<p>You may use the <code class=" language-php">where</code> method on a query builder instance to add <code class=" language-php">where</code> clauses to the query. The most basic call to <code class=" language-php">where</code> requires three arguments. The first argument is the name of the column. The second argument is an operator, which can be any of the database's supported operators. Finally, the third argument is the value to evaluate against the column.</p>


<pre class="language-php"><p><code class="CodeFlask__code language-php"><span class="token delimiter important">&lt;?php</span>
<span class="token keyword">include_once</span><span class="token punctuation">(</span><span class="token string">"Elegant/Model.php"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token keyword">class</span> <span class="token class-name">Book</span> <span class="token keyword">extends</span> <span class="token class-name">Model</span> <span class="token punctuation">{</span>

    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">__construct</span><span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>  
        <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">table_name</span> <span class="token operator">=</span> <span class="token string">'books'</span><span class="token punctuation">;</span>
        <span class="token keyword">parent</span><span class="token punctuation">:</span><span class="token punctuation">:</span><span class="token function">__construct</span><span class="token punctuation">(</span><span class="token variable">$this</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>

    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">getBook</span><span class="token punctuation">(</span><span class="token variable">$title</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
        <span class="token keyword">return</span> <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where</span><span class="token punctuation">(</span><span class="token string">'title'</span><span class="token punctuation">,</span> <span class="token string">'='</span><span class="token punctuation">,</span> <span class="token variable">$title</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span>
<span class="token delimiter important">?&gt;</span>
</code></p></pre>


<p><a name="and-statements"></a></p>
<h4>And Statements</h4>
<p>You may chain <code>where</code> constraints together with one or more calls to <code>where</code> in order to add <code class=" language-php"><span class="token keyword">AND</span></code> clauses to the query:</p>


<pre class="language-php"><p><code class="CodeFlask__code language-php"><span class="token variable">$order_model</span> <span class="token operator">=</span> <span class="token keyword">new</span> <span class="token class-name">Order</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token variable">$order_model</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where</span><span class="token punctuation">(</span><span class="token string">'customer_id'</span><span class="token punctuation">,</span><span class="token string">'='</span><span class="token punctuation">,</span><span class="token number">1</span><span class="token punctuation">)</span>
            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where</span><span class="token punctuation">(</span><span class="token string">'amount'</span><span class="token punctuation">,</span> <span class="token string">'&gt;'</span><span class="token punctuation">,</span> <span class="token number">100</span><span class="token punctuation">)</span>
            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where</span><span class="token punctuation">(</span><span class="token string">'amount'</span><span class="token punctuation">,</span> <span class="token string">'&lt;'</span><span class="token punctuation">,</span> <span class="token number">400</span><span class="token punctuation">)</span>
            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">/**
 *  This is similar to the sql query:
 *      SELECT * FROM orders WHERE customer_id = 1 AND amount &gt; 100 AND amount &lt; 400;
 */</span>
</code></p></pre>




<p><a name="or-statements"></a></p>
<h4>Or Statements</h4>
<p>You may chain <code>where</code> constraints together with one or more calls to <code>orWhere</code> in order to add <code class=" language-php"><span class="token keyword">OR</span></code> clauses to the query. The <code class=" language-php">orWhere</code> method accepts the same arguments as the <code class=" language-php">where</code> method:</p>


<pre class="language-php"><p><code class="CodeFlask__code language-php"><span class="token variable">$order_model</span> <span class="token operator">=</span> <span class="token keyword">new</span> <span class="token class-name">Order</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token variable">$order_model</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where</span><span class="token punctuation">(</span><span class="token string">'customer_id'</span><span class="token punctuation">,</span><span class="token string">'='</span><span class="token punctuation">,</span><span class="token number">1</span><span class="token punctuation">)</span>
            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">orWhere</span><span class="token punctuation">(</span><span class="token string">'amount'</span><span class="token punctuation">,</span> <span class="token string">'='</span><span class="token punctuation">,</span> <span class="token number">125</span><span class="token punctuation">)</span>
            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">orWhere</span><span class="token punctuation">(</span><span class="token string">'amount'</span><span class="token punctuation">,</span> <span class="token string">'&gt;'</span><span class="token punctuation">,</span> <span class="token number">400</span><span class="token punctuation">)</span>
            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">/**
 *  This is similar to the sql query:
 *      SELECT * FROM orders WHERE customer_id = 1 OR amount = 125 OR amount &gt; 400;
 */</span>
</code></p></pre>



<!-- END OF WHERE CLAUSES -->

<!-- JOIN CLAUSES -->

<p><a name="join-clauses"></a></p>
<h2><a href="#join-clauses">Join Clauses</a></h2>
<p><a name="inner-join-clauses"></a></p>
<h4>Join and Inner Join </h4>
<p> Inner join and join will result in a table which is based on the realtion of two common columns </p>

<pre class="language-php"><code class="language-php"><span class="token variable">$customer</span> <span class="token operator">=</span> <span class="token keyword">new</span> <span class="token class-name">Customer</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token variable">$ft</span> <span class="token operator">=</span> <span class="token string">'orders'</span><span class="token punctuation">;</span>
<span class="token variable">$pk</span> <span class="token operator">=</span> <span class="token string">'Customers.CustomerID'</span><span class="token punctuation">;</span>
<span class="token variable">$op</span> <span class="token operator">=</span> <span class="token string">'='</span><span class="token punctuation">;</span>
<span class="token variable">$fk</span> <span class="token operator">=</span> <span class="token string">'Orders.CustomerID'</span><span class="token punctuation">;</span>
<span class="token variable">$results</span> <span class="token operator">=</span> <span class="token variable">$customer</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">innerJoin</span><span class="token punctuation">(</span><span class="token variable">$ft</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">on</span><span class="token punctuation">(</span><span class="token variable">$pk</span><span class="token punctuation">,</span><span class="token variable">$op</span><span class="token punctuation">,</span><span class="token variable">$fk</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
</code></pre>

<pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token variable">$customer</span> <span class="token operator">=</span> <span class="token keyword">new</span> <span class="token class-name">Customer</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token variable">$ft</span> <span class="token operator">=</span> <span class="token string">'orders'</span><span class="token punctuation">;</span>
<span class="token variable">$pk</span> <span class="token operator">=</span> <span class="token string">'Customers.CustomerID'</span><span class="token punctuation">;</span>
<span class="token variable">$op</span> <span class="token operator">=</span> <span class="token string">'='</span><span class="token punctuation">;</span>
<span class="token variable">$fk</span> <span class="token operator">=</span> <span class="token string">'Orders.CustomerID'</span><span class="token punctuation">;</span>
<span class="token variable">$results</span> <span class="token operator">=</span> <span class="token variable">$customer</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">join</span><span class="token punctuation">(</span><span class="token variable">$ft</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">on</span><span class="token punctuation">(</span><span class="token variable">$pk</span><span class="token punctuation">,</span><span class="token variable">$op</span><span class="token punctuation">,</span><span class="token variable">$fk</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
</code></pre>


<p><a name="left-right-join-clauses"></a></p>
<h4>Left Join and Right Join </h4>
<p> A Left Join return all records from the left table matched with records from the right table and vice versa</p>

<pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token variable">$customer</span> <span class="token operator">=</span> <span class="token keyword">new</span> <span class="token class-name">Customer</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token variable">$ft</span> <span class="token operator">=</span> <span class="token string">'orders'</span><span class="token punctuation">;</span>
<span class="token variable">$pk</span> <span class="token operator">=</span> <span class="token string">'Customers.CustomerID'</span><span class="token punctuation">;</span>
<span class="token variable">$op</span> <span class="token operator">=</span> <span class="token string">'='</span><span class="token punctuation">;</span>
<span class="token variable">$fk</span> <span class="token operator">=</span> <span class="token string">'Orders.CustomerID'</span><span class="token punctuation">;</span>
<span class="token variable">$results</span> <span class="token operator">=</span> <span class="token variable">$customer</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">leftJoin</span><span class="token punctuation">(</span><span class="token variable">$ft</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">on</span><span class="token punctuation">(</span><span class="token variable">$pk</span><span class="token punctuation">,</span><span class="token variable">$op</span><span class="token punctuation">,</span><span class="token variable">$fk</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
</code></pre>


<pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token variable">$customer</span> <span class="token operator">=</span> <span class="token keyword">new</span> <span class="token class-name">Customer</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token variable">$ft</span> <span class="token operator">=</span> <span class="token string">'orders'</span><span class="token punctuation">;</span>
<span class="token variable">$pk</span> <span class="token operator">=</span> <span class="token string">'Customers.CustomerID'</span><span class="token punctuation">;</span>
<span class="token variable">$op</span> <span class="token operator">=</span> <span class="token string">'='</span><span class="token punctuation">;</span>
<span class="token variable">$fk</span> <span class="token operator">=</span> <span class="token string">'Orders.CustomerID'</span><span class="token punctuation">;</span>
<span class="token variable">$results</span> <span class="token operator">=</span> <span class="token variable">$customer</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">rightJoin</span><span class="token punctuation">(</span><span class="token variable">$ft</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">on</span><span class="token punctuation">(</span><span class="token variable">$pk</span><span class="token punctuation">,</span><span class="token variable">$op</span><span class="token punctuation">,</span><span class="token variable">$fk</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
</code></pre>


<p><a name="full-join-clauses"></a></p>
<h4>Full Join </h4>
<p> A Full Join return all records whether there is a match in the left or right</p>

<pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token variable">$customer</span> <span class="token operator">=</span> <span class="token keyword">new</span> <span class="token class-name">Customer</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token variable">$ft</span> <span class="token operator">=</span> <span class="token string">'orders'</span><span class="token punctuation">;</span>
<span class="token variable">$pk</span> <span class="token operator">=</span> <span class="token string">'Customers.CustomerID'</span><span class="token punctuation">;</span>
<span class="token variable">$op</span> <span class="token operator">=</span> <span class="token string">'='</span><span class="token punctuation">;</span>
<span class="token variable">$fk</span> <span class="token operator">=</span> <span class="token string">'Orders.CustomerID'</span><span class="token punctuation">;</span>
<span class="token variable">$results</span> <span class="token operator">=</span> <span class="token variable">$customer</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">fullJoin</span><span class="token punctuation">(</span><span class="token variable">$ft</span><span class="token punctuation">,</span><span class="token variable">$pk</span><span class="token punctuation">,</span><span class="token variable">$op</span><span class="token punctuation">,</span><span class="token variable">$fk</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
</code></pre>

<p><a name="cross-join-clauses"></a></p>
<h4>Cross Join </h4>
<p> A Cross Join will return the cartesian product of two tables result in the number of rows from left table to be multiplied by the number of rows in the right table</p>

<pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token variable">$customer</span> <span class="token operator">=</span> <span class="token keyword">new</span> <span class="token class-name">Customer</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token variable">$ft</span> <span class="token operator">=</span> <span class="token string">'orders'</span><span class="token punctuation">;</span>
<span class="token variable">$results</span> <span class="token operator">=</span> <span class="token variable">$customer</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">crossJoin</span><span class="token punctuation">(</span><span class="token variable">$ft</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
</code></pre>

<!-- END OF JOIN CLAUSES -->

<!-- PAGINATE -->

<p><a name="paginate"></a></p>
<h2><a href="#paginate">Pagination</a></h2>
<p> The paginate function will return an array of data indexed at page 1 to the last page which can be accessed
    through the key <code> 'last_page' </code>. It can be combined at the end of a clause.</p>

<pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token function">session_start</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token variable">$_SESSION</span><span class="token punctuation">[</span><span class="token string">'product-row-count'</span><span class="token punctuation">]</span> <span class="token operator">=</span> <span class="token number">5</span><span class="token punctuation">;</span>
<span class="token variable">$_SESSION</span><span class="token punctuation">[</span><span class="token string">'product-order-by'</span><span class="token punctuation">]</span> <span class="token operator">=</span> <span class="token string">'ProductID'</span><span class="token punctuation">;</span>
<span class="token variable">$_SESSION</span><span class="token punctuation">[</span><span class="token string">'product-order-desc'</span><span class="token punctuation">]</span> <span class="token operator">=</span> <span class="token constant">FALSE</span><span class="token punctuation">;</span>
<span class="token variable">$_SESSION</span><span class="token punctuation">[</span><span class="token string">'page'</span><span class="token punctuation">]</span> <span class="token operator">=</span> <span class="token number">1</span><span class="token punctuation">;</span>
<span class="token variable">$p</span> <span class="token operator">=</span> <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">product_model</span>
           <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">orderBy</span><span class="token punctuation">(</span><span class="token variable">$_SESSION</span><span class="token punctuation">[</span><span class="token string">'product-order-by'</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token variable">$_SESSION</span><span class="token punctuation">[</span><span class="token string">'product-order-desc'</span><span class="token punctuation">]</span><span class="token punctuation">)</span>
           <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">paginate</span><span class="token punctuation">(</span><span class="token number">5</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token function">session_write_close</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token variable">$products</span> <span class="token operator">=</span> <span class="token variable">$p</span><span class="token punctuation">[</span><span class="token number">1</span><span class="token punctuation">]</span><span class="token punctuation">;</span>
<span class="token variable">$products_last_page</span> <span class="token operator">=</span> <span class="token variable">$p</span><span class="token punctuation">[</span><span class="token string">'last_page'</span><span class="token punctuation">]</span><span class="token punctuation">;</span>
</code></pre>


<!-- END OF PAGINATE -->
</div>

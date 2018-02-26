<div style="background-color:#fff" class="jumbotron">
<article>
<h1>Elegant: Getting Started</h1>
<ul>
    <li><a href="#introduction">Introduction</a></li>
    <li><a href="#database-configuration">Database Configuration</a></li>
    <li><a href="#defining-models">Defining Models</a>
        <ul>
            <li><a href="#Elegant-model-conventions">Elegant Model Conventions</a></li>
        </ul>
    </li>
    <li><a href="#retrieving-models">Retrieving Models</a>
        <ul>
            <li><a href="#adding-additional-constraints">Adding Additional Constraints</a></li>
            <li><a href="#working-with-data">Working with Data</a></li>
        </ul>
    </li>
    <li>
        <a href="#inserting-and-updating-models">Inserting &amp; Updating Models</a>
        <ul>
            <li><a href="#inserts">Inserts</a></li>
            <li><a href="#updates">Updates</a></li>
        </ul>
    </li>
    <li><a href="#deletes">Deletes</a>
</ul>



<!-- introduction -->
<p><a name="introduction"></a></p>
<h2><a href="#introduction">Introduction</a></h2>
<p>Elegant is more than just a ORM. Elegant is also a database query builder, with a built-in database handler that enables an active record pattern implementation.  Elegant is adaptable with any custom mvc project and could be used with many other popular php frameworks such as, Laravel and Codeigniter. By simply dropping a copy of the Elegant directory in any php mvc project you could get started on using the wonderful features of Elegant.  Each database table has a corresponding "Model" that interacts with that table. Models allow you to build and execute MySQL queries.
</p>
<p>Before getting started, be sure to configure a database connection in <code class=" language-php">Elegant<span class="token operator">/</span>dbconfig<span class="token punctuation">.</span>php</code>. For more information on configuring your database, check out <a href="#database-configuration">the documentation</a>.</p>



<!-- database-configuration -->
<p><a name="database-configuration"></a></p>
<h2><a href="#database-configuration">Database Configuration</a></h2>
<p>Inside the Elegant folder, you can find the dbconfig.php file.  Set the proper configurations to use with your database.
                <pre class="language-php"><p><code class="CodeFlask__code  language-php"><span class="token delimiter important">&lt;?php</span>
    <span class="token comment" spellcheck="true">/*
        Elegant/dbconfig.php
    */</span>
    <span class="token function">define</span><span class="token punctuation">(</span><span class="token string">"DB_HOST"</span><span class="token punctuation">,</span><span class="token string">"localhost"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token function">define</span><span class="token punctuation">(</span><span class="token string">"DB_USER"</span><span class="token punctuation">,</span><span class="token string">"root"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token function">define</span><span class="token punctuation">(</span><span class="token string">"DB_PASS"</span><span class="token punctuation">,</span><span class="token string">"your-password"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token function">define</span><span class="token punctuation">(</span><span class="token string">"DB_NAME"</span><span class="token punctuation">,</span><span class="token string">"your-database-name"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token delimiter important">?&gt;</span>
</code></p></pre>
</p>



<!-- defining-models -->
<p><a name="defining-models"></a></p>
<h2><a href="#defining-models">Defining Models</a></h2>
<p>To get started, let's create an Elegant model. All Elegant models extend <code class=" language-php">Elegant<span class="token punctuation">\</span>Model</span></code> class.</p>




<!-- Elegant-model-conventions -->
<p><a name="Elegant-model-conventions"></a></p>
<h3>Elegant Model Conventions</h3>
<p>Now, let's look at an example <code class=" language-php">Book</code> model, which we will use to retrieve and store information from our <code class=" language-php">books</code> database table:</p>

        <pre class="language-php"><p><code class="CodeFlask__code  language-php"><span class="token delimiter important">&lt;?php</span>
<span class="token keyword">include_once</span><span class="token punctuation">(</span><span class="token string">"Elegant/Model.php"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">Book</span> <span class="token keyword">extends</span> <span class="token class-name">Model</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">//note: Every model must have a construct and a call to parent.</span>
    <span class="token keyword">public</span> <span class="token function">__construct</span><span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
        <span class="token keyword">parent</span><span class="token punctuation">:</span><span class="token punctuation">:</span><span class="token function">__construct</span><span class="token punctuation">(</span><span class="token variable">$this</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span>
<span class="token delimiter important">?&gt;</span>
</code></p></pre>


<!-- Table Names -->
<h4>Table Names</h4>
<p>Note that we did not tell Elegant which table to use for our <code class=" language-php">Book</code> model in the previous code snippet. By convention, table names in Elegant use the "snake case" name of the model classes, in all lower case letters unless a different table name is explicitly specified within the model Book's construct as done in the code snippet below:


        <pre class="language-php"><p><code class="CodeFlask__code  language-php"><span class="token delimiter important">&lt;?php</span>
<span class="token keyword">include_once</span><span class="token punctuation">(</span><span class="token string">"Elegant/Model.php"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token keyword">class</span> <span class="token class-name">Book</span> <span class="token keyword">extends</span> <span class="token class-name">Model</span>
<span class="token punctuation">{</span>
    <span class="token keyword">public</span> <span class="token function">__construct</span><span class="token punctuation">(</span><span class="token punctuation">)</span> 
    <span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">
       /**
        * The table name associated with the model.
        *
        * @var string
        */</span>
        <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">table_name</span> <span class="token operator">=</span> <span class="token string">'books'</span><span class="token punctuation">;</span>
        <span class="token keyword">parent</span><span class="token punctuation">:</span><span class="token punctuation">:</span><span class="token function">__construct</span><span class="token punctuation">(</span><span class="token variable">$this</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span>
<span class="token delimiter important">?&gt;</span>
</code></p></pre>


<!-- retrieving models -->
<p><a name="retrieving-models"></a></p>
<h2><a href="#retrieving-models">Retrieving Models</a></h2>


<!-- Adding Additional Constraints-->
<p><a name="adding-additional-constraints"></a></p>
<h4>Adding Additional Constraints</h4>
<p>The Elegant <code class=" language-php">all</code> method will return all of the results in the model's table. Since each Elegant model serves as a <a href="./?query-builder">query builder</a>, you may also add constraints to queries, and then use the <code class=" language-php">get</code> method to retrieve the results:</p>


<pre class="language-php"><p><code class="CodeFlask__code  language-php"><span class="token delimiter important">&lt;?php</span>
<span class="token variable">$book_model</span> <span class="token operator">=</span> <span class="token keyword">new</span> <span class="token class-name">Book</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token variable">$cols</span> <span class="token operator"> =</span> <span class="token keyword"> array</span><span class="token punctuation">(</span><span class="token string">'title'</span><span class="token punctuation">,</span> <span class="token string">'author'</span><span class="token punctuation">,</span> <span class="token string">'description'</span><span class="token punctuation">,</span> <span class="token string">'genre'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token variable">$books</span> <span class="token operator">=</span> <span class="token variable"> $book_model</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where</span><span class="token punctuation">(</span><span class="token string">'active'</span><span class="token punctuation">,</span> <span class="token string">'='</span><span class="token punctuation">,</span> <span class="token string">'1'</span><span class="token punctuation">)</span>
            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">orWhere</span><span class="token punctuation">(</span><span class="token string">'title'</span><span class="token punctuation">,</span> <span class="token string">'='</span><span class="token punctuation">,</span> <span class="token string">'Harry Potter'</span><span class="token punctuation">)</span>
            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">orderBy</span><span class="token punctuation">(</span><span class="token string">'name'</span><span class="token punctuation">,</span> <span class="token string">'desc'</span><span class="token punctuation">)</span>
            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">take</span><span class="token punctuation">(</span><span class="token number">10</span><span class="token punctuation">)</span>
            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token variable">$cols</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
            <span class="token delimiter important">?&gt;</span>
</code></p></pre>


Since Elegant models are query builders, you should review all of the methods available on the <a href="./?query-builder">query builder</a>. You may use any of these methods in your Elegant queries.</p>

<!-- Working with data -->
<p><a name="working-with-data"></a></p>
<h3>Working with Data</h3>
<p>For Elegant methods like <code class=" language-php">all</code> and <code class=" language-php">get</code> retrieve results that are stored in an <code class=" language-php">Array</code> where each row can be reached by an integer index.  Each row contains an instance of an <code class=" language-php">Child Model</code>, where each property is the column name holding the value returned from the database. The following code snippet is an example for working with your Elegant results:</p>



        <pre class="language-php"><p><code class="CodeFlask__code  language-php"><span class="token delimiter important">&lt;?php</span>
    <span class="token comment" spellcheck="true">/*    in controller    */</span>
    <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">book_model</span> <span class="token operator">=</span> <span class="token keyword">new</span> <span class="token class-name">Book</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token variable">$books</span> <span class="token operator">=</span> <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">book_model</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">getBookList</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token keyword">include</span> <span class="token string">'view/templates/header.php'</span><span class="token punctuation">;</span>
    <span class="token keyword">include</span> <span class="token string">'view/pages/booklist.php'</span><span class="token punctuation">;</span>
    <span class="token keyword">include</span> <span class="token string">'view/templates/footer.php'</span><span class="token punctuation">;</span>

    <span class="token comment" spellcheck="true">/*    in view    */</span>
    <span class="token keyword">foreach</span><span class="token punctuation">(</span> <span class="token variable">$books</span> <span class="token keyword">as</span> <span class="token variable">$book</span><span class="token punctuation">)</span> 
    <span class="token punctuation">{</span>
        <span class="token keyword">echo</span> <span class="token variable">$book</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">title</span><span class="token punctuation">.</span><span class="token string">"&lt;/br&gt;"</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token delimiter important">?&gt;</span>
</code></p></pre>

<!-- inserting-and-updating-models -->
<p><a name="inserting-and-updating-models"></a></p>
<h2><a href="#inserting-and-updating-models">Inserting &amp; Updating Models</a></h2>
</br>

<p><a name="inserts"></a></p>
<h3>Inserts</h3>
<p>To create a new record in the database, simply create a new model instance, set attributes on the model, then call the <code class=" language-php">save</code> method:</p>


<pre class="language-php"><p><code class="CodeFlask__code  language-php"><span class="token delimiter important">&lt;?php</span>
<span class="token keyword">include_once</span><span class="token punctuation">(</span><span class="token string">"Elegant/Model.php"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token keyword">class</span> <span class="token class-name">Customer</span> <span class="token keyword">extends</span> <span class="token class-name">Model</span> 
<span class="token punctuation">{</span>
	<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">__construct</span><span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>  
		<span class="token keyword">parent</span><span class="token punctuation">:</span><span class="token punctuation">:</span><span class="token function">__construct</span><span class="token punctuation">(</span><span class="token variable">$this</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
	<span class="token punctuation">}</span>

	<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">create</span> <span class="token punctuation">(</span><span class="token variable">$name</span><span class="token punctuation">,</span> <span class="token variable">$address</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
		<span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">name</span> <span class="token operator">=</span> <span class="token variable">$name</span><span class="token punctuation">;</span>
		<span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">address</span> <span class="token operator">=</span> <span class="token variable">$address</span><span class="token punctuation">;</span>
		<span class="token keyword">return</span> <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">save</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
	<span class="token punctuation">}</span>
<span class="token punctuation">}</span>
<span class="token delimiter important">?&gt;</span>
</code></p></pre>


<h3>Updates</h3>
<p><a name="updates"></a></p>



<pre class="language-php"><p><code class="CodeFlask__code  language-php"><span class="token delimiter important">&lt;?php</span>
<span class="token keyword">include_once</span><span class="token punctuation">(</span><span class="token string">"Elegant/Model.php"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token keyword">class</span> <span class="token class-name">Customer</span> <span class="token keyword">extends</span> <span class="token class-name">Model</span> 
<span class="token punctuation">{</span>
	<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">__construct</span><span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>  
		<span class="token keyword">parent</span><span class="token punctuation">:</span><span class="token punctuation">:</span><span class="token function">__construct</span><span class="token punctuation">(</span><span class="token variable">$this</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
	<span class="token punctuation">}</span>

	<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">updateById</span> <span class="token punctuation">(</span><span class="token variable">$id</span><span class="token punctuation">,</span> <span class="token variable">$name</span><span class="token punctuation">,</span> <span class="token variable">$address</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
		<span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">name</span> <span class="token operator">=</span> <span class="token variable">$name</span><span class="token punctuation">;</span>
		<span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">address</span> <span class="token operator">=</span> <span class="token variable">$address</span><span class="token punctuation">;</span>
                <span class="token keyword">return</span> <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where</span><span class="token punctuation">(</span><span class="token string">'id'</span><span class="token punctuation">,</span> <span class="token string">'='</span><span class="token punctuation">,</span> <span class="token variable">$id</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">save</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
	<span class="token punctuation">}</span>
<span class="token punctuation">}</span>
<span class="token delimiter important">?&gt;</span>
</code></p></pre>



<!-- Deletes -->
<p><a name="deletes"></a></p>
<h2><a href="#deletes">Deletes</a></h2>
<p>To delete a model, specify by chaing a call to the method <code>where</code> with a call to the <code class=" language-php">delete</code> method on a model instance:</p>



<pre class="language-php"><p><code class="CodeFlask__code  language-php"><span class="token delimiter important">&lt;?php</span>
<span class="token keyword">include_once</span><span class="token punctuation">(</span><span class="token string">"Elegant/Model.php"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token keyword">class</span> <span class="token class-name">Customer</span> <span class="token keyword">extends</span> <span class="token class-name">Model</span> 
<span class="token punctuation">{</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">__construct</span><span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>  
        <span class="token keyword">parent</span><span class="token punctuation">:</span><span class="token punctuation">:</span><span class="token function">__construct</span><span class="token punctuation">(</span><span class="token variable">$this</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>

    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">removeById</span><span class="token punctuation">(</span><span class="token variable">$id</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
        <span class="token keyword">return</span> <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where</span><span class="token punctuation">(</span><span class="token string">'id'</span><span class="token punctuation">,</span> <span class="token string">'='</span><span class="token punctuation">,</span> <span class="token variable">$id</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">delete</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span>
<span class="token delimiter important">?&gt;</span>
</code></p></pre>









</div>
</article>
</div>
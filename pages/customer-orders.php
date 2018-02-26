<div class="jumbotron">

<h2>One to Many Relations</h2>
<p> One customer can have many orders hence to one-to-many.</p>
<p> The Elegant ORM code snippet required for these results: </p> 

<pre class="language-php"><p><code class="CodeFlask__code  language-php"><span class="token variable">$customers_pk</span> <span class="token operator">=</span> <span class="token string">'id'</span><span class="token punctuation">;</span>
<span class="token variable">$fk1</span> <span class="token operator">=</span> <span class="token string">'customer_id'</span><span class="token punctuation">;</span>
<span class="token keyword">return</span> <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">oneToMany</span><span class="token punctuation">(</span><span class="token string">'orders'</span><span class="token punctuation">,</span> <span class="token variable">$customers_pk</span><span class="token punctuation">,</span> <span class="token variable">$fk1</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
</code></p></pre>

</br>

<img class="relationsImage" src="assets/images/OneToMany.PNG"></img>
</br>

<h1> <?php echo $customer->CustomerName?>'s Customer Info</h1>
<ul>
<li>
<p>CustomerID: <?php echo $customer->CustomerID?></p>
</li>
<li>
<p>ContactName: <?php echo $customer->ContactName?></p>
</li>
<li>                  
<p>Address: <?php echo $customer->Address.', '.$customer->City.', '.$customer->PostalCode.', '.$customer->Country;?></p>
</li>

</ul>

<?php 
if(sizeof($customer_orders) > 0) 
{ 
?>
<h2> <?php echo $customer->CustomerName?>'s Orders</h2>
<table class="table table-hover">
	<thead>
      <tr>
        <th>OrderID</th>
        <th>EmployeeID</th>
        <th>OrderDate</th>
        <th>ShipperID</th>
      </tr>
    </thead>
    <?php foreach ($customer_orders as $c) { ?>
    <tr>
      <td><p><?php echo $c->OrderID ?></p></td>
      <td><p><?php echo $c->EmployeeID ?></p></td>
      <td><p><?php echo $c->OrderDate ?></p></td>
      <td><p><?php echo $c->ShipperID ?></p></td>
    </tr>
    <?php } ?>
</table>
<?php 
} 
else
{
?>
<h2> <?php echo $customer->CustomerName?> has not placed any orders.</h2>
<?php
}
?>
</br>	

</br>

</div>
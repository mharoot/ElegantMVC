<?php   
ini_set('display_errors',1);
 error_reporting(E_ALL); 
 ?>

 <div class="jumbotron">
<h3> Products </h3>
<form action = "." method="post">
<p> Display 
<select name="product-row-count" onchange="this.form.submit()">
  <option value="select" selected> -select- </option>
  <option value="5">5</option>
  <option value="10">10</option>
  <option value="15">15</option>
</select>
products </p>
</form>

<form action = "." method="post">
<p> Order By
<select name="product-order-by" onchange="this.form.submit()">
  <option value="select" selected> -select- </option>
  <option value="ProductID">Product ID</option>
  <option value="ProductName"> Product Name</option>
  <option value="Unit">Unit</option>
  <option value="Price">Price</option>
</select>
</p>
</form>

<form action = "." method="post">
<p> Descending
<select name="product-order-desc" onchange="this.form.submit()">
  <option value="select" selected> -select- </option>
  <option value="0">NO</option>
  <option value="1">YES</option>
</select>
</p>
</form>

<table  class="table table-hover table-striped">
	<thead>
      <tr>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Unit</th>
        <th>Price</th>
      </tr>
    </thead>
	<?php 

   foreach ($products as $p) 
    {
      $str = '<tr> <td>'. $p->ProductID . '</td>';
      $str .= '<td> '.$p->ProductName . '</td>';
      $str .= '<td> '.$p->Unit . '</td>';
      $str .= '<td> '.$p->Price . '</td> </tr>';
      echo $str;

    }



	?>
</table>

<ul class="pager">
  <li><a href="./?products-prev">Previous</a></li>
  <li><a href="./?products-next">Next</a></li>
</ul>

</div>
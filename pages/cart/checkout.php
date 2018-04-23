
<style type="text/css">
	
	.table-head{
		background-color: white !important;
		color: #316884 !important;	
	}
</style>

<div class="brand-box">
    Order Confirmation
</div>

<form action="./confirmcheckout" method="POST" style="padding: 20px">
<div class="row" style="padding: 20px">
<table class="table" style="background-color: white;color: #316884;">
  <thead>
    <tr>
      <th class = "table-head" scope="col">Product ID</th>
      <th class = "table-head" scope="col">Name </th>
      <th class = "table-head" scope="col">Price</th>
      <th class = "table-head" scope="col">Quantity</th>
    </tr>
  </thead>
  <tbody>
<?php
        $totalPrice = 0;
        $index = 0;

  
    
        foreach($items['product'] as $p)
        {
            $q = $items['quantity'][$index][$p->ProductID];
            $index++;
            $totalPrice+=$p->Price * $q;

            echo 	'<tr>
      				<th class = "table-head" scope="row">'.$p->ProductID.'</th>
      				<td>'.$p->ProductName.'</td>
      				<td>$'.$p->Price.'</td>
      				<td>'.$q.'</td>
    				</tr>';

        }


?>
</tbody>

</table>
<table class="table table-bordered table-light" style="background-color: white !important;color: #316884;">
  <thead class="thead-light">
    <tr>
      <th class = "table-head" scope="col">Total</th>
      <th class = "table-head" scope="col"> Confirmation </th>
    </tr>
  </thead>
  <tbody>
  	<?php echo'<tr>
      				<th class = "table-head" scope="row">$'.$totalPrice.'</th>
      				<td class = "table-head">
      				<button style="background-color: white;color: #316884; border: 1px solid;" class="btn btn-light btn-lg">
                                        Confirm Order
					</button>
					</td>
    				</tr>';
    ?>
  </tbody>
</table>


<div class="row">
<div class="col">
<a href="./products" style="color: #316884; border: 1px solid;" class="btn btn-light btn-lg">
                                        Continue Shopping
</a>
</div>
<div class="col">
<a href="./cart" style="color: #316884; border: 1px solid;" class="btn btn-light btn-lg">
                                        Back to Cart
</a>
</div>
</div>

</div>
</form>
<div class="container">
  <div class="brand-box" style="height: 200px">
    Review Billing Information
</div>
<?php
echo
'<table>
	<tr><td>CustomerID</td><td>'.$info[0]->CustomerID.'</td></tr>
	<tr><td>CustomerName</td><td>'.$info[0]->CustomerName.'</td></tr>
	<tr><td>ContactName</td><td>'.$info[0]->ContactName.'</td></tr>
	<tr><td>Address</td><td>'.$info[0]->Address.'</td></tr>
	<tr><td>City</td><td>'.$info[0]->City.'</td></tr>
	<tr><td>PostalCode</td><td>'.$info[0]->PostalCode.'</td></tr>
	<tr><td>Country</td><td>'.$info[0]->Country.'</td></tr>
</table> 
	<form action="./edit-billing-information" method="post">
	<button class="btn btn-primary" type="submit" > Edit info </button>
	</form>
	'
?>

</div>
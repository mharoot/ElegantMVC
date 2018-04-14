<div class="container">
<div class="brand-box" style="height: 200px">Review Billing Information</div>

<div class="row">
<?php
if ( isset($_SESSION['success_message']) ) 
{
    echo '<p style="color:green">'.$_SESSION['success_message'].'</p>';
    unset($_SESSION['success_message']);
} 
else if ( isset($_SESSION['error_message']) ) 
{
    echo '<p style="color:red">'.$_SESSION['error_message'].'</p>';
    unset($_SESSION['error_message']);
}
?>
</div>

  <div class="row">
<?php     
if ( isset($customer_info) && $customer_info != false)
{
?>
<form action="./edit-billing-information" method="POST">
	<table>
	<tr>
		<td>Customer Name</td>
		<td><input type='text' name='CustomerName' value="<?php echo $customer_info->CustomerName; ?>"></td>
	</tr>
		
	<tr>
		<td>Contact Name</td> 
		<td><input type='text' name='ContactName' value="<?php echo $customer_info->ContactName; ?>"></td>
	</tr>
	
	<tr>
		<td>Address</td> 
		<td><input type='text' name='Address' value="<?php echo $customer_info->Address; ?>"></td>
	</tr>
	
	<tr>
		<td>City</td> 
		<td><input type='text' name='City' value="<?php echo $customer_info->City; ?>"></td>
	</tr>

	<tr>
		<td>Country</td> 
		<td><input type='text' name='Country' value="<?php echo $customer_info->Country; ?>"></td>
	</tr>
	
	<tr>
		<td>Postal Code</td> 
		<td><input type='text' name='PostalCode' value="<?php echo $customer_info->PostalCode; ?>"></td>
	</tr>
	</table>
	<button class='btn btn-primary' type='submit' value='Submit'> Update Billing Information </button>
</form>
<?php
} 
else
{
?>
<form action="./edit-billing-information" method="POST">
	<table>
	<tr>
		<td>Customer Name</td>
		<td><input type='text' name='CustomerName' value=""></td>
	</tr>
		
	<tr>
		<td>Contact Name</td> 
		<td><input type='text' name='ContactName' value=""></td>
	</tr>

	<tr>
		<td>Address</td> 
		<td><input type='text' name='Address' value=""></td>
	</tr>

	<tr>
		<td>City</td> 
		<td><input type='text' name='City' value=""></td>
	</tr>

	<tr>
		<td>Country</td> 
		<td><input type='text' name='Country' value=""></td>
	</tr>

	<tr>
		<td>Postal Code</td> 
		<td><input type='text' name='PostalCode' value=""></td>
	</tr>
	</table>
	<button class='btn btn-primary' type='submit' value='Submit'> Update Billing Information </button>
</form>
<?php
}
?>
</div>
</div>
<?php   
ini_set('display_errors',1);
 error_reporting(E_ALL); 

 ?>
 <div class="jumbotron">
<h3> Customers </h3>

<table id="booklist" class="table table-hover table-striped">
	<thead>
      <tr>
        <th>Customer ID</th>
        <th>Name</th>
        <th>Address</th>
      </tr>
    </thead>
	<?php 

    foreach ($customers as $customer) 
    {
      echo "<tr><td><p>". $customer->CustomerID . '</p>';
      ?>
            <a class="btn btn-primary" href="./?customer-orders=<?php echo $customer->CustomerID;?>">View Customer's Orders</a>
            </td> 
            <td><p>
      <?php
      echo  $customer->CustomerName.'</p></td> <td><p>'.$customer->Address.', '.$customer->City.', '.$customer->PostalCode.', '.$customer->Country;
      ?>
           </p>
           <form method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="CustomerID" value="<?php echo $customer->CustomerID;?>">
            <input class="btn btn-danger" type="submit" value="Delete" name="delete-customer" />
				   </form>
           </td></tr>
      <?php
		}

	?>
</table>
<h1> Insert New Customer </h1>
<form method="POST">
  <div class="form-group">
    <input class="form-control" type="text" name="CustomerName" placeholder="Customer Name" required>
    <input class="form-control" type="text" name="ContactName" placeholder="Contact Name" required>
    <input class="form-control" type="text" name="Address" placeholder="Address" required>
    <input class="form-control" type="text" name="City" placeholder="City" required>
    <!-- polish postal code pattern covers most cases http://html5pattern.com/Postal_Codes -->
    <input class="form-control" type="text" name="PostalCode" placeholder="Postal Code" pattern="[0-9]{2}\-[0-9]{3}"  required >
    <input class="form-control" type="text" name="Country" placeholder="Country" required>
    <input type="submit" class="btn btn-info" value="Submit" name="insert-customer">
  </div>
</form>
</div>
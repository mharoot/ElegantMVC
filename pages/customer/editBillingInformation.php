<div class="container">
  <div class="brand-box" style="height: 200px">
    Edit Billing Information
</div>
<?php

			echo "<form action='./insert-new-billing-information' method='post'>
            <table>
            <tr><td>Customer Name</td><td><input type='text' name='customername' value='".$info[0]->CustomerName."'></td></tr>
            
            <tr><td>Contact name</td> <td><input type='text' name='contactname' value='".$info[0]->ContactName."'></td></tr>
            
            <tr><td>Address</td> <td><input type='text' name='address' value='".$info[0]->Address."'></td></tr>
            
            <tr><td>City</td> <td><input type='text' name='city' value='".$info[0]->City."'></td></tr>
            
            <tr><td>Postal Code</td> <td><input type='text' name='postalcode' value='".$info[0]->PostalCode."'></td></tr>
            
            <tr><td>Country</td> <td><input type='text' name='country' value='".$info[0]->Country."'></td></tr>
            </table>
            <button class='btn btn-primary' type='submit' value='Submit'> Update Billing Information </input>
            </form>";
?>

</div>
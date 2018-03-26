<div class="container">
  <div class="brand-box" style="height: 200px">Review Business Information</div>

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
if ( isset($supplier_info) && $supplier_info != false)
{
?>
    <form action="./edit-business-information" method="POST">
        <table>
            <tr>
                <td>Supplier Name</td>
                <td><input type="text" name="SupplierName" value="<?php echo $supplier_info->SupplierName; ?>"></td>
            </tr>
            
            <tr>
                <td>Contact Name</td>
                <td><input type="text" name="ContactName" value="<?php echo $supplier_info->ContactName; ?>"></td>
            </tr>
            
            <tr>
                <td>Address</td> 
                <td><input type="text" name="Address" value="<?php echo $supplier_info->Address; ?>"></td>
            </tr>
            
            <tr>
                <td>City</td> 
                <td><input type="text" name="City" value="<?php echo $supplier_info->City; ?>"></td>
            </tr>
            
            <tr>
                <td>Postal Code</td> 
                <td><input type="text" name="PostalCode" value="<?php echo $supplier_info->PostalCode; ?>"></td>
            </tr>
            
            <tr>
                <td>Country</td> 
                <td><input type="text" name="Country" value="<?php echo $supplier_info->Country; ?>"></td>
            </tr>

            <tr>
                <td>Phone</td> 
                <td><input type="tel" name="Phone" value="<?php echo $supplier_info->Phone; ?>"></td>
            </tr>
        </table>
        <button class='btn btn-primary' type='submit' value='Submit'> Update Business Information </input>
    </form>
  </div>
<?php
} 
else
{
?>
<form action="./edit-business-information" method="POST">
    <table>
        <tr>
            <td>Supplier Name</td>
            <td><input type="text" name="SupplierName" value=""></td>
        </tr>
        
        <tr>
            <td>Contact Name</td>
            <td><input type="text" name="ContactName" value=""></td>
        </tr>
        
        <tr>
            <td>Address</td> 
            <td><input type="text" name="Address" value=""></td>
        </tr>
        
        <tr>
            <td>City</td> 
            <td><input type="text" name="City" value=""></td>
        </tr>
        
        <tr>
            <td>Postal Code</td> 
            <td><input type="text" name="PostalCode" value=""></td>
        </tr>
        
        <tr>
            <td>Country</td> 
            <td><input type="text" name="Country" value=""></td>
        </tr>

        <tr>
            <td>Phone</td> 
            <td><input type="tel" name="Phone" value=""></td>
        </tr>
    </table>
    <button class='btn btn-primary' type='submit' value='Submit'> Update Business Information </input>
</form>
<?php
}
?>
</div>

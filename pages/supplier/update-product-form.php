  <div class="brand-box" style="height: 200px">Review Product Information</div>

  <div class="row">
<?php
if ( isset($_SESSION['success_message']) ) 
{
    echo '<p style="color:green">'.$_SESSION['success_message'].'</p></br>';
    unset($_SESSION['success_message']);
} 
else if ( isset($_SESSION['error_message']) ) 
{
    echo '<p style="color:red">'.$_SESSION['error_message'].'</p></br>';
    unset($_SESSION['error_message']);
}
?>
  </div>

  <div class="row">
<?php     
if ( isset($supplier_product) && $supplier_product != false)
{
?>
    <form action="./edit-product-information" method="POST">
        <table>
            <tr>
                <td>Product Name</td>
                <td><input type="text" name="ProductName" value="<?php echo $supplier_product->ProductName; ?>"></td>
            </tr>
            
            <tr>
                <td>CategoryID</td>
                <td><input type="text" name="CategoryID" value="<?php echo $supplier_product->CategoryID; ?>"></td>
            </tr>
            
            <tr>
                <td>Unit</td> 
                <td><input type="text" name="Unit" value="<?php echo $supplier_product->Unit; ?>"></td>
            </tr>
            
            <tr>
                <td>Price</td> 
                <td><input type="text" name="Price" value="<?php echo $supplier_product->Price; ?>"></td>
            </tr>
            
            <tr>
                <td>Quantity</td> 
                <td><input type="text" name="Quantity" value="<?php echo $supplier_product->Quantity; ?>"></td>
            </tr>
        </table>
        <button class='btn btn-primary' type='submit' value='Submit'> Update Product Information </input>
    </form>
  </div>
<?php
} 
else
{
?>
<form action="./edit-product-information" method="POST">
    <table>
        <tr>
            <td>Product Name</td>
            <td><input type="text" name="ProductName" value=""></td>
        </tr>

        <tr>
            <td>CategoryID</td>
            <td><input type="text" name="CategoryID" value=""></td>
        </tr>

        <tr>
            <td>Unit</td> 
            <td><input type="text" name="Unit" value=""></td>
        </tr>

        <tr>
            <td>Price</td> 
            <td><input type="text" name="Price" value=""></td>
        </tr>

        <tr>
            <td>Quantity</td> 
            <td><input type="text" name="Quantity" value=""></td>
        </tr>

    </table>
    <button class='btn btn-primary' type='submit' value='Submit'> Insert Product Information </input>
</form>
<?php
}
?>


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
  </br>
  <div class="row">
<?php     
if ( isset($supplier_products) && $supplier_products != false)
{
?>
    
        <table>
            <th>ProductName</th><th>CategoryID</th><th>Unit</th><th>Price</th><th>Quantity</th><th>Modify</th>
<?php foreach ($supplier_products as $supplier_product) {?>
            <tr>
                <td><?php echo $supplier_product->ProductName;?> </td>
                <td><?php echo $supplier_product->CategoryID;?> </td>
                <td><?php echo $supplier_product->Unit;?> </td>
                <td><?php echo $supplier_product->Price;?> </td>
                <td><?php echo $supplier_product->Quantity;?> </td>
                <td><a class="btn btn-primary" href="./update-product-form?productId=<?php echo $supplier_product->ProductID; ?>">Edit</a> | <a class="btn btn-danger" href="./delete-product?productId=<?php echo $supplier_product->ProductID; ?>">Delete</a></td>
            </tr>
            
<?php } ?>
        </table>

<?php
} 
?>

    </br>
    <a class="btn btn-success" href="./update-product-form">Insert a New Product</a>
  </div>
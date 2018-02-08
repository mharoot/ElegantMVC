<ul>
<?php
    foreach(  $suppliers as $supplier)
    {
          echo 
          "<li>
            <ul>
            <li>SupplierID: $supplier->SupplierID</li>
            <li>SupplierName: $supplier->SupplierName </li>  
            <li>ContactName: $supplier->ContactName </li>
            <li>Address: $supplier->Address </li>
            <li>City: $supplier->City </li>
            <li>PostalCode: $supplier->PostalCode </li>
            <li>Country: $supplier->Country </li>
            <li>Phone: $supplier->Phone </li>
            </ul>
          </li>";
    }
?>
</ul>
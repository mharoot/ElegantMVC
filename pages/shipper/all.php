<ul>
<?php
foreach(  $shippers as $shipper)
{
echo "<li>
        <ul>
            <li>ShipperID: $shipper->ShipperID</li>
            <li>ShipperName: $shipper->ShipperName </li>  
            <li>Phone: $shipper->Phone </li>
        </ul>
    </li>";
}
?>
</ul>
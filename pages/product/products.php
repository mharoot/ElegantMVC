<div class="container dp">

	<?php
        foreach ($products as $p) 
        {?>

        <div class="row">
            <ul style="list-style-type: none;"><li><b>Product: </b><?php echo $p->ProductName; ?></li>
                <li><b>SupplierID: </b><?php echo $p->SupplierID; ?></li>
                <li><b>CategoryID: </b><?php echo $p->CategoryID; ?></li>
                <li><b>Unit: </b><?php echo $p->Unit; ?></li>
                <li><b>Price: </b><?php echo $p->Price; ?></li>
            </ul>
        </div>

    <?php
        }?>
        
</div>
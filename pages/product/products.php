<div class="container dp">

	<?php
        foreach ($products as $p) 
        {?>

        <div class="row">
            <ul style="list-style-type: none;"><li><b>Product: </b><?php echo $p->ProductName; ?></li>
                <li><b>Supplier Name: </b><?php echo $p->SupplierName; ?></li>
                <li><b>Category Name: </b><?php echo $p->CategoryName; ?></li>
                <li><b>Unit: </b><?php echo $p->Unit; ?></li>
                <li><b>Price: </b><?php echo $p->Price; ?></li>
            </ul>
        </div>

    <?php
        }?>
        
</div>
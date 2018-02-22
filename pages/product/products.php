<div class="container dp">
	<?php
        foreach ($products as $p) {
        echo '<div class="row"><p>'.$p->ProductName."</p>
        <p>".$p->SupplierID ."</p>
        <p>".$p->CategoryID ."</p>
        <p>".$p->Unit ."</p>
        <p>".$p->Price ."</p></div>";
    	}
    ?>
</div>

<div class="container">
<div class="row">
<h2> Ship Order Form </h2>
</div>
<?php 

foreach ($shippers as $s) {?>
<div class="row">
<form action="./ship-order" method="POST">
   <input type="hidden" value="<?php echo $OrderID;?>" name="OrderID"></input>
   <input type="hidden" value="<?php echo $s->ShipperID;?>" name="ShipperID"></input>
   <button class="btn btn-primary"><?php echo $s->ShipperName;?></button>
</form>
<br></br>
</div>
<?php
}
?>
</div>
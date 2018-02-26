<div class="sidenav">
	<?php
	foreach ($categories as $c) 
	{
		echo '<a href=./products?id='. $c->CategoryID.'>'.$c->CategoryName."</a>";
	}

	?>
</div>

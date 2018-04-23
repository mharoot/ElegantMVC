<div class="container">

	<?php
        foreach ($product as $p) 
        {?>

        <button  type="submit" class="list-group-item list-group-item-action">
                            <a style="text-decoration: none;" href=<?php echo '"./select?q='.$p->ProductName.'"'; ?>>
                            <div style="text-align: center;">
                                <i style="color: #316884" class="fas fa-image fa-10x"></i>
                            </div>
                            <ul style="list-style-type: none;">
                                <li>
                                <b>Product: </b>
                                    <?php echo $p->ProductName; ?></li>
                                <li>
                                    <b>Unit: </b><?php echo $p->Unit; ?>
                                </li>
                                <li>
                                    <b>Price: </b><?php echo $p->Price; ?>
                                </li>
                                <li style="color: green;">
                                    <b> In Stock: </b> <?php echo $p->Quantity ?>
                                </li>
                                <li>
                                    <a href="./addCart?i=<?php echo $p->ProductID; ?>" style="color: #316884; border: 1px solid;" class="btn btn-light btn-lg">
                                        <i class="fas fa-shopping-cart"></i>  Cart
                                    </a>
                           
                                    <a href="./addWish?i=<?php echo $p->ProductID; ?>" style="color: #316884; border: 1px solid;" class="btn btn-light btn-lg">
                                        <i class="fas fa-heart"></i> Wishlist
                                    </a>
                                </li>
                            </ul>
                            
                            </a>
        </button>

    <?php
        }?>
        
</div>
<style type="text/css">
.glyphicon { margin-right:5px; }
.thumbnail
{
    margin-bottom: 20px;
    padding: 0px;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    border-radius: 0px;
}

.item.list-group-item
{
    float: none;
    width: 100%;
    background-color: #fff;
    margin-bottom: 10px;
}
.item.list-group-item:nth-of-type(odd):hover,.item.list-group-item:hover
{
    background: #428bca;
}

.item.list-group-item .list-group-image
{
    margin-right: 10px;
}
.item.list-group-item .thumbnail
{
    margin-bottom: 0px;
}
.item.list-group-item .caption
{
    padding: 9px 9px 0px 9px;
}
.item.list-group-item:nth-of-type(odd)
{
    background: #eeeeee;
}

.item.list-group-item:before, .item.list-group-item:after
{
    display: table;
    content: " ";
}

.item.list-group-item img
{
    float: left;
}
.item.list-group-item:after
{
    clear: both;
}
.list-group-item-text
{
    margin: 0 0 11px;
}

.list-group-item:hover
{
    color: rgba(49, 104, 132, 1);
    background-color: rgba(49, 104, 132, .2);
}
#products{
    max-width: 100%;
    overflow-x: hidden;
}

</style>

<div class= "col-2" style="position: relative;">
<div class="col-2" style="position: fixed;">
 <div  class="list-group">
    <h3 align="center" style="color:  rgba(49, 104, 132, 1);">  Categories </h3>

        <?php
        foreach ($category as $c) 
        {
            echo '<a href=./products?id='.$c->CategoryID.'><div style="border-radius: 0px"class="list-group-item"><center>'
            .$c->CategoryName."</center></div></a>";
        }

        ?>
</div>
</div>
</div>


<div class="col-8" style="left: 10%">
 <div  class="list-group">
        
        <?php
        foreach($products as $p)
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
                        </br>
                                    

                <?php
            }?>
</div>

</div>







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

</style>


<div class="brand-box">
    Shopping Cart 
</div>
<form action="./updateCart" method="POST" >
<div class="row">

 <div class="list-group">
<?php
        $totalPrice = 0;
        $index = 0;
        foreach($items['product'] as $p)
        {
            
            $q = $items['quantity'][$index][$p->ProductID];
            $index++;
            $totalPrice+=$p->Price * $q;

?>

            <div class="list-group-item">
                <div style="text-align: center;">
                    <i style="color: #316884" class="fas fa-image fa-10x"></i>
                </div>
                    <ul style="list-style-type: none;">
                        <li>
                            <b>Product: </b>
                                <?php echo $p->ProductName; ?>
                        </li>
                        <li>
                            <b>Unit: </b><?php echo $p->Unit; ?>
                        </li>
                            <li>
                                <b>Price: </b><?php echo $p->Price; ?>
                            </li>
                            <li style="color: green">
                                <b> In Stock: </b> <?php echo $p->Quantity ?>
                            </li>
                        <li>
                            Quantity:
                            <input class="form-control" name="cartUpdate[]" type="number" min="0" step="1" value=<?php echo '"'.$q.'"';?> >

                            </input>
                           
                                    
                        </li>
                    </ul>
                        
            </div>
        </br>
                                    
<?php
            }
?>
</div>
<div class="container">
<p> Total Price: <?php echo $totalPrice;?> </p>
<a href="./products" style="color: #316884; border: 1px solid;" class="btn btn-light btn-lg">
                                        Continue Shopping
</a>



<button style="background-color: white;color: #316884; border: 1px solid;" class="btn btn-light btn-lg">
                                        Update Cart
</button>



<a href="./checkout" style="color: #316884; border: 1px solid;" class="btn btn-light btn-lg">
                                        Checkout
</a>
</div>

</div>
</form>
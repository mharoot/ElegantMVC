<div class="container">
<div class="row">
   <h2> Orders </h2>
</div>  
   <div class="row">
    <?php
    if ( isset($_SESSION['success_message']) ) 
    {
        echo '<p style="color:green">'.$_SESSION['success_message'].'</p>';
        unset($_SESSION['success_message']);
    } 
    else if ( isset($_SESSION['error_message']) ) 
    {
        echo '<p style="color:red">'.$_SESSION['error_message'].'</p>';
        unset($_SESSION['error_message']);
    }
    ?>
    </div>
   <table class="table" style="background-color: white;color: #316884;">
   <thead>
   <tr>
       <th style="background-color: white;color: #316884;" scope="col">Order ID</th>
       <th style="background-color: white;color: #316884;"scope="col"> Date </th>
       <th style="background-color: white;color: #316884;" scope="col"> Status </th>
   </tr>
   </thead>
   <tbody>
<?php
       foreach ($orders as $o) {

           $status = "<td> <a class='btn btn-warning' href='./ship-order-form?OrderID=$o->OrderID'>Not Shipped</a></td>";
           if($o->OrderStatus > 0)
           {
               $status = '<td style="color: green;"> Shipped </td>';
           }
         echo '<tr>
               <td>'.$o->OrderID.'</td>
               <td>'.$o->OrderDate.'</td>'.$status.
               '</tr>';
       }
?>
</tbody>
</table>
</div>
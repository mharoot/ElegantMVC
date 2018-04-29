<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            
            <div class="account-wall">
<?php
            if(isset($_SESSION["registration_success"])) 
            { 
              foreach($_SESSION["registration_success"] as $error)
              {
                echo '<p style="color:green;"><b>'.$error .'</b></p>';
              }
              unset($_SESSION["registration_success"]);
            }
?>
            <h1 class="text-center login-title"> Hi <?php echo $_SESSION["first_name"]; ?>! </h1>
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">
                <p> <b>Username:</b> <?php echo $_SESSION["user_name"]; ?> <a href="./edit-user-name-form">Edit</a></p>
                <p> <b>Email:</b>    <?php echo $_SESSION["user_email"]; ?> <a href="./edit-user-email-form">Edit</a></p>
                <p><a href="./edit-user-password-form">Change Password</a></p>


<?php 
                echo $_SESSION['DashboardContent'];
?>

                
                <a href="./logout" class="pull-right need-help">Logout? </a>
            </br>
        </div>

    </div>
     <?php
        if($_SESSION['user_type'] == 2)
        {
    ?>
    <div class="col">
        <h2> Orders </h2>
        <table class="table" style="background-color: white;color: #316884;">
        <thead>
        <tr>
            <th style="background-color: white;color: #316884;" scope="col">Order ID</th>
            <th style="background-color: white;color: #316884;" scope="col">Product Name </th>
            <th style="background-color: white;color: #316884;" scope="col">Supplier Name </th>
            <th style="background-color: white;color: #316884;" scope="col">Quantity </th>
            <th style="background-color: white;color: #316884;"scope="col"> Date </th>
            <th style="background-color: white;color: #316884;" scope="col"> Status </th>
        </tr>
        </thead>
        <tbody>
   <?php
            foreach ($orders as $o) {

                $status = '<td style="color: red;">Not Shipped</td>';
                if($o->OrderStatus > 0)
                {
                    $status = '<td style="color: green;"> Shipped </td>';
                }
              echo '<tr>
                    <td>'.$o->OrderID.'</td>
                    <td>'.$o->ProductName.'</td>
                    <td>'.$o->SupplierName.'</td>
                    <td>'.$o->Quantity.'</td>
                    <td>'.$o->OrderDate.'</td>'.$status.
                    '</tr>';
            }
        }
    ?>
    </tbody>
    </table>
    </div>
</div>
<div>
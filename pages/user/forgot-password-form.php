<div class="container">
  <div class="brand-box">
    Retrieve Password for Elegant E-Commerce Store User Account!
  </div>
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
  <div class="row">
    <div class="col">
      <form action="./forgot-password" method="post">
        <div class="form-group">
          <input name="user_name" type="text" class="form-control fc" placeholder="username or email" required>
        </div>
       <button type="submit" class="btn btn-primary">Retrieve Account</button>
     </form>
   </div>
 </div>
</div>
<div class="container">
  <div class="brand-box">
    Edit Password
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
      <form action="./edit-password" method="post">
        <div class="form-group">
            <input name="user_password_new" type="password" class="form-control fc" placeholder="password" required="">
        </div>
        <div class="form-group">
            <input name="user_password_repeat" type="password" class="form-control fc" placeholder="repeat password" required="">
        </div>
        <input type="hidden" name="user_name" value="<?php echo $_GET['user_name'];?>">
        <input type="hidden" name="verification_code" value="<?php echo $_GET['verification_code'];?>">
       <button type="submit" class="btn btn-primary">Change Password</button>
     </form>
   </div>
 </div>
</div>
<div class="container">
  <div class="brand-box">
    Elegant E-Commerce Store Login 
  </div>
  <div class="row">
    <div class="col">
      <form action="./loggingin" method="post">
        <div class="form-group">
          <input name="user_name" type="text" class="form-control fc" placeholder="username" required>
        </div>
        <div class="form-group">
          <input name="password" type="password" class="form-control fc" placeholder="password" required>
        </div>

        <?php
        if(isset($_SESSION["login_error"]))
        {

          echo '<p style="color:#DC143C;">'. $_SESSION["login_error"][0]. '</p>';

          unset($_SESSION["login_error"]);
        }

        ?>

        <div class="checkbox">
         <label>
           <input name="remember_me" type="checkbox"> Remember me
         </label>
         <input  type="hidden" value="No" name="remember_me">
       </div>
       <button type="submit" class="btn btn-primary">Sign in</button>
     </form>
   </div>
   <div class="col">
    <form action="./register" method="get">
       <button class="btn btn-lg btn-primary btn-block" type="submit">
         Create an account
       </button>
    </form>
   </div>
 </div>
</div>
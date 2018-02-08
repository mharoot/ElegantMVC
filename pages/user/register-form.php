<div class="container">
  <div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4">
      <h1 class="text-center login-title">Register for ElegantMVC</h1>
      <div class="account-wall">
        <form class="form-signin" method="POST">
          <div class="form-group"><input name="first_name" type="text" class="form-control" placeholder="First name" required="" autofocus=""></div>
          <div class="form-group"><input name="last_name" type="text" class="form-control" placeholder="Last name" required="" autofocus=""></div>
          <div class="form-group"><input name="email" type="email" class="form-control" placeholder="Email" required="" autofocus=""></div>
          <div class="form-group"><input name="user_name" type="text" class="form-control" placeholder="User name" required="" autofocus=""></div>
          <div class="form-group"><input name="password" type="password" class="form-control" placeholder="Password" required=""></div>
          <div class="form-group"><input name="repeat_password" type="password" class="form-control" placeholder="Repeat password" required=""></div>
          <div class="form-group">
            <div><label class="checkbox"><input name="customer" type="checkbox" value="customer">Customer</label></div>
            <div><label class="checkbox"><input name="employee" type="checkbox" value="employee">Employee</label></div>
            <div><label class="checkbox"><input name="supplier" type="checkbox" value="supplier">Supplier</label></div>
          </div>
          <div class="form-group">
            <img src="<?php echo $base_url;?>assets/tools/showCaptcha.php" alt="captcha" />
            <label>Captcha</label>
            <input type="text" name="captcha" required />
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Create Account</button>
        </form>
      </div>
    </div>
  </div>
</div>
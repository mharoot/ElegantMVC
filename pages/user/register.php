<div class="container">
  <div class="brand-box" style="height: 200px">
    Elegant E-Commerce Store Registration
  </div>
  <form action= "./registered" class="form-signin" method="POST">
    <div class="form-group">
      <input name="user_email" type="email" class="form-control fc" placeholder="email" required="" autofocus="">
    </div>
    <div class="form-group">
      <input name="first_name" type="text" class="form-control fc" placeholder="first name" required="" autofocus="">
    </div>
    <div class="form-group">
      <input name="last_name" type="text" class="form-control fc" placeholder="last name" required="" autofocus="">
    </div>
    <div class="form-group">
      <input name="user_name" type="text" class="form-control fc" placeholder="username" required="" autofocus="">
    </div>
    <div class="form-group">
      <input name="user_password_new" type="password" class="form-control fc" placeholder="password" required="">
    </div>
    <div class="form-group">
      <input name="user_password_repeat" type="password" class="form-control fc" placeholder="repeat password" required="">
    </div>
    <div class="form-group">
      <label> Select account type </label>
      <select name="user_type">
        <option value="2"> Customer </option>
        <option value="3"> Employee </option>
        <option value="4"> Supplier </option>
      </select>
      <?php
      if(isset($_SESSION["registration_error"])) 
      { 
        foreach($_SESSION["registration_error"] as $error)
        {
          echo '<p style="color:#DC143C;">'.$error .'</p>';
        }
        unset($_SESSION["registration_error"]);
      }
      ?>
    </div>
    <div class="form-group">
      <img src="./assets/tools/showCaptcha.php" alt="captcha" />
      <label>Captcha</label>
      <input type="text" name="captcha" required />
    </div>
    <button name="register" class="btn btn-lg btn-primary btn-block" type="submit">Create Account</button>
  </form>
</div>
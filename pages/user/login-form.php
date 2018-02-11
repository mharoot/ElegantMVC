 
 <?php
if (isset($_POST['user_name']) && isset($_POST['password']))
{
    echo "</br>Given username: ".$_POST['user_name'].", password: ".$_POST['password'];
    $remember_me = null;
    if (isset($_POST['remember_me']))
    {
        echo "</br>remember me is set</br>";
        $remember_me = true;
    }

    $this->controller->login($_POST['user_name'], $_POST['password'], $remember_me);
    echo "<br></br>SESSION username: ".$_SESSION['user_name'];
    $url = $base_url."user/login";
    header("Location: $url");
}
else if (isset($_SESSION['user_name']))
{
    ?>
    <div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title"> <?php echo "Hi ".$_SESSION['first_name']."!";?> </h1>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">
                <p> Username: <?php echo $_SESSION['user_name'];?></p>
                <a href="<?php echo $base_url;?>user/logout" class="pull-right need-help">Logout? </a>
                </br>
            </div>
        </div>
    </div>
    <div>
<?php
}
else
{
?>
    <div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Sign in to continue to ElegantMVC</h1>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">
                <form class="form-signin" method="POST">
                <input name="user_name" type="text" class="form-control" placeholder="Email" required="" autofocus="">
                <input name="password" type="password" class="form-control" placeholder="Password" required="">
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Sign in</button>
                <label class="checkbox pull-left">
                    <input name="remember_me" type="checkbox" value="remember-me">
                    Remember me
                </label>
                <a href="#" class="pull-right need-help">Forgot Password? </a><span class="clearfix"></span>
                </form>
            </div>
            <a href="<?php echo $base_url;?>user/register" class="text-center new-account">Create an account </a>
        </div>
    </div>
</div>

<?php
}
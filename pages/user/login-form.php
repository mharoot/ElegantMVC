 
 <?php
if (isset($_POST['user_name']) && isset($_POST['password']))
{
    echo "</br>Given username: ".$_POST['user_name'].", password: ".$_POST['password'];
    $remember_me = true;
    $this->controller->login($_POST['user_name'], $_POST['password'], $remember_me);
    echo "<br></br>SESSION username: ".$_SESSION['user_name'];
    $url = $base_url."user/login";
    header("Location: $url");
}
else if (isset($_SESSION['user_name']))
{
    print "Your logged in as: ".$_SESSION['user_name'];

}
else
{
?>
    <h3> Login </h3>
    <form method="POST">
        <div class="form-group">
            <label for="user_name">Username:</label>
            <input name="user_name"></input>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input name="password" type="password" ></input>
            
        </div>
        <div class="form-group">
        <input class="btn-primary" type="submit"></input>
        </div>
    </form>
<?php
}
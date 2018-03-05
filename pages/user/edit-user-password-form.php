<div class="container">
    <div class="brand-box">Edit Password</div>

<?php
if(isset($_SESSION["success_message"])) {
    foreach($_SESSION["success_message"] as $message) {
        echo '<p style="color:green;"><b>'.$message .'</b></p>';
    }
    unset($_SESSION["success_message"]);
} else if(isset($_SESSION["error_message"])) {
    foreach($_SESSION["error_message"] as $message) {
        echo '<p style="color:red;"><b>'.$message .'</b></p>';
    }
    unset($_SESSION["error_message"]);
}
?>

    <div class="row">
        <div class="col">
            <form action="./edit-user-password" method="post">
                <div class="form-group">
                    <input name="user_password_old" type="password" class="form-control fc" placeholder="repeat password" required="">
                </div>
                <div class="form-group">
                    <input name="user_password_new" type="password" class="form-control fc" placeholder="password" required="">
                </div>
                <div class="form-group">
                    <input name="user_password_repeat" type="password" class="form-control fc" placeholder="repeat password" required="">
                </div>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            
            <div class="account-wall">
            <h1 class="text-center login-title"> Hi <?php echo $_SESSION["first_name"]; ?>! </h1>
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">
                <p> <b>Username:</b> <?php echo $_SESSION["user_name"]; ?></p>
                <p> <b>Email:</b>    <?php echo $_SESSION["user_email"]; ?></p>
                <a href="./logout" class="pull-right need-help">Logout? </a>
            </br>
        </div>
    </div>
</div>
<div>
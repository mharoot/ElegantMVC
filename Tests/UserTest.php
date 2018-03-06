<?php
// in command line run all tests: 
// phpunit Tests/  
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include_once('Elegant/Model.php');
include_once('Models/user_model.php');
class UserTest extends TestCase
{

  /*
  public function test_all() 
  {
    $UserModel = new UserModel();
    $Users = $UserModel->all();
    $we_have_all_Users = sizeof($Users) > 0;
    $UserModel->assertTrue( $we_have_all_Users );
  }
*/
  
/*public function test_login()
  {
    $UserModel = new UserModel();
    $user_name = 'MichaelHarootoonyan';
    $user_password = 'password';
    $user_rememberme = false; // note you can't use this with true in tests, however it works when ran from the browser.
    $user_was_logged_in = $UserModel->loginWithPostData($user_name, $user_password, $user_rememberme);
    $UserModel->assertTrue( $user_was_logged_in );
  }*/

  
/*
  public function test_logout()
  {
    $UserModel = new UserModel();
    $user_name = 'MichaelHarootoonyan';
    $user_password = 'password';
    $user_rememberme = null;
    $UserModel->loginWithPostData($user_name, $user_password, $user_rememberme);
    $UserModel->assertTrue( $UserModel->doLogout() );
  }
*/
  /* test passed
  public function test_emailer()
  {
    $UserModel = new UserModel();
    $user_id = '1';
    $user_email = 'elegantorm@gmail.com';
    $user_activation_hash = '4mkdol31304ldsf94ldlooks_something_like_that';
    $email_has_been_sent = $UserModel->sendVerificationEmail($user_id, $user_email, $user_activation_hash);
    $UserModel->assertTrue( $email_has_been_sent );
  }
  */



  /*public function test_registration()
  {
    $UserModel = new UserModel();
    $UserModel->user_email           = 'elegantorm@gmail.com';
    $UserModel->user_type            = 2;
    $UserModel->first_name           = 'Elegant';
    $UserModel->last_name            = 'ORM';
    $UserModel->user_name            = 'ElegantORM';
    $UserModel->user_password_hash   = '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi';
    $UserModel->user_activation_hash = 'Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQvdyex1edJrl';
    $UserModel->user_registration_ip = '127.0.0.1';
    $UserModel->user_registration_datetime = date('Y-m-d H:i:s');
    $new_user_inserted = $UserModel->save();
    $this->assertTrue( $new_user_inserted );
  }
  */
  
  /* passed
  public function test_integration_registration()
  {
    $UserModel = new UserModel();  
    $user_email           = 'elegantorm@gmail.com';
    $user_type            = 2;
    $first_name           = 'Elegant';
    $last_name            = 'ORM';
    $user_name            = 'ElegantORM';
    $password             = 'password';
    $captcha              = 'captcha';
    $_SESSION['captcha']  = $captcha;


    $result = $UserModel->registerNewUser($user_email, $user_type, $first_name, $last_name, $user_name, $password, $password, $captcha);

    $this->assertTrue($result);

  }
  */

  public function test_reset_failed_login_counter()
  {
    $UserModel = new UserModel();
    $UserModel->user_failed_logins = 0;
    $UserModel->user_last_failed_login = NULL;
    $reset_the_failed_login_counter = $UserModel->where('user_id', '=', 1)->save();
    $this->assertTrue($reset_the_failed_login_counter);
  }
  
  
    

}
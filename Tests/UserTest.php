<?php
// in command line run all tests: 
// phpunit Tests/  
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include_once('Elegant/Model.php');
include_once('Models/User_model.php');
class UserTest extends TestCase
{
  public function test_all() 
  {
    $UserModel = new UserModel();
    $Users = $UserModel->all();
    $we_have_all_Users = sizeof($Users) > 0;
    $this->assertTrue( $we_have_all_Users );
  }

  public function test_login()
  {
    $UserModel = new UserModel();
    $user_name = 'MichaelHarootoonyan';
    $user_password = 'password';
    $user_rememberme = null;
    $user_was_logged_in = $UserModel->loginWithPostData($user_name, $user_password, $user_rememberme);
    $this->assertTrue( $user_was_logged_in );
  }

  public function test_logout()
  {
    $UserModel = new UserModel();
    $user_name = 'MichaelHarootoonyan';
    $user_password = 'password';
    $user_rememberme = null;
    $UserModel->loginWithPostData($user_name, $user_password, $user_rememberme);
    $this->assertTrue( $UserModel->doLogout() );
  }

  /* pass test
  public function test_registration()
  {
    $UserModel = new UserModel();
    $user_type = 1; // 1 = admin
    $first_name = 'Chad';
    $last_name  = 'Buntrakulsuk';
    $user_name  = 'ChadBuntrakulsuk';
    $user_password = 'password';
    $user_password_repeat = 'password';
    $captcha = 'random_captcha';
    $new_user_was_registered = $UserModel->registerNewUser($user_type, $first_name, $last_name, 
    $user_name, $user_password, $user_password_repeat, $captcha);
    $this->assertTrue( $new_user_was_registered );
  }
    */

}
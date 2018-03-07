<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
include_once('Elegant/Model.php');
include_once('Models/user_model.php');

class ElegantModelTest extends TestCase
{
    public function test_single_existing()
    {
        $Model = new UserModel();
        $selected_cols_optional = array('user_id');
        $user = $Model->where("user_id", "=", 1)->single($selected_cols_optional);
        $this->assertTrue(isset($user->user_id));
    }

    public function test_single_non_existing()
    {
        $Model = new UserModel();
        $selected_cols_optional = array('user_id');
        $user = $Model->where("user_id", "=", 0)->single($selected_cols_optional);
        $this->assertTrue(isset($user->user_id) == false);
    }
}
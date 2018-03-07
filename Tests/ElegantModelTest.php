<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
include_once('Elegant/Model.php');
include_once('Models/user_model.php');

class ElegantModelTest extends TestCase
{
    public function test_single()
    {
        $Model = new UserModel();
        $selected_cols_optional = array('user_id');
        $user = $Model->where("user_id", "=", 1)->single($selected_cols_optional);
        var_dump($user);
        $this->assertTrue(isset($user->user_id));
    }
}
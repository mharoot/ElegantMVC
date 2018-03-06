<?php
declare(strict_types=1);
session_start();


//REQUIRED FILES
require_once __DIR__.'/Elegant/Model.php';
$files = glob(__DIR__.'/Models/*.php');
foreach ($files as $file) {
    require_once ($file);   
}
$files = glob(__DIR__.'/Views/*.php');
foreach ($files as $file) {
    require_once ($file);  
}
$files = glob(__DIR__.'/Controllers/*.php');
foreach ($files as $file) {
    require_once ($file);  
}
require_once (__DIR__.'/Router.php');

$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : '/';

$_SESSION["page"] = $url[0];

if(!isset($_SESSION["user_type"]))
{
	$_SESSION["authorization"] = 0;
}
else
{
	$_SESSION["authorization"] = $_SESSION["user_type"];
}

unset($_SESSION["content"]);
$_SESSION["content"] = "";


$router = new Router();
                //name       //controller //method //authorization ids
$router->addRoute("/","IndexController","index");
$router->addRoute("index","IndexController","index");


/**
 *              Product Routes
 */
$router->addRoute("products","ProductController","displayProducts");
$router->addRoute("products","CategoryController","displayCategory");
$router->addRoute("productsPost","ProductController","paste");
$router->addRoute("food","ProductController","food");

/**
 *              About Routes
 */
$router->addRoute("about-model", "AboutController", "aboutModel");
$router->addRoute("about","AboutController","about");
$router->addRoute("about-query-builder", "AboutController", "aboutQueryBuilder");
$router->addRoute("db-uml", "AboutController", "dbUML");



/**
 *              User Routes
 */
$router->addRoute("dashboard","UserController","displayDashboard");

$router->addRoute("edit-password", "UserController", "editPassword");
$router->addRoute("edit-password-form", "UserController", "displayEditPasswordForm");

$router->addRoute("edit-user-email", "UserController", "editUserEmail",array(1,2,3,4));
$router->addRoute("edit-user-email-form", "UserController", "displayEditUserEmailForm",array(1,2,3,4));

$router->addRoute("edit-user-name", "UserController", "EditUserName",array(1,2,3,4));
$router->addRoute("edit-user-name-form", "UserController", "displayEditUserNameForm",array(1,2,3,4));

$router->addRoute("edit-user-password", "UserController", "editUserPassword",array(1,2,3,4));
$router->addRoute("edit-user-password-form", "UserController", "displayEditUserPasswordForm",array(1,2,3,4));

$router->addRoute("forgot-password", "UserController", "userForgotPasswordEmailReset");
$router->addRoute("forgot-password-form", "UserController", "displayForgotPasswordForm");

$router->addRoute("login","UserController","displayLogin");
$router->addRoute("loggingin","UserController","login");
$router->addRoute("logout","UserController","logout");

$router->addRoute("register","UserController","displayRegistration");
$router->addRoute("registered","UserController","registerUser");
$router->addRoute("user-email-verification", "UserController", "userEmailActivation");

/**
 *              Customer Routes
 */

$router->addRoute("review-billing-information", "CustomerController", "reviewBillingInformation",array(2));
$router->addRoute("edit-billing-information", "CustomerController", "editBillingInformation",array(2));
$router->addRoute("insert-new-billing-information", "CustomerController", "insertNewBillingInformation",array(2));


/**
 *              Supplier Routes
 */
$router->addRoute("suppliers", "SupplierController", "displaySupplier");

if(count($_GET) > 0)
{
    $router->routePage($url[0],$_GET);
}
else if(count($_POST) > 0)
{
    $router->routePage($url[0],$_POST);
}
else
{
    $router->routePage($url[0],array());
}


?>
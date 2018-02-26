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
$router->addRoute("products","ProductController","displayProducts");
$router->addRoute("products","CategoryController","displayCategory");
$router->addRoute("productsPost","ProductController","paste");
$router->addRoute("food","ProductController","food");
$router->addRoute("about","AboutController","about");
$router->addRoute("login","UserController","displayLogin");
$router->addRoute("loggingin","UserController","login");
$router->addRoute("logout","UserController","logout");
$router->addRoute("dashboard","UserController","displayDashboard");
$router->addRoute("register","UserController","displayRegistration");
$router->addRoute("registered","UserController","registerUser");
$route_name = "about-model";
$controller = "AboutController";
$controller_function = "aboutModel";
$router->addRoute($route_name, $controller, $controller_function);
$router->addRoute("user-email-verification", "UserController", "userEmailActivation");

$router->addRoute("review-billing-information", "CustomerController", "reviewBillingInformation",array(2));
$router->addRoute("edit-billing-information", "CustomerController", "editBillingInformation",array(2));
$router->addRoute("insert-new-billing-information", "CustomerController", "insertNewBillingInformation",array(2));


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
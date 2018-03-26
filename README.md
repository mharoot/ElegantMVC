# ElegantMVC
Transitioning from super controller to instance of controllers and views

### .htaccess
```
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f

RewriteRule ^(.+)$ index.php/$1 [L]
```

### Database
```
+----------------+
| Tables_in_test |
+----------------+
| categories     |
| customers      |
| employees      |
| orderdetails   |
| orders         |
| products       |
| shippers       |
| suppliers      |
+----------------+
```

# MVC Structure
To explain this further models should not have to have an instance of the controller or view. The view should not have an instance of model or controller. The only thing that should have an instance of model and view is the controller in order to pass data properly to the view from the model the controller has to invoke a function in order to do so
an example of how a controller class should be set up not we invoke a function from the model and pass it as a parameter into the view.

I'm going to post the fix into my own branch along with some other changes to routing.

```php
class ProductController
{


private $view;
private $model;
public function __construct()
{
$this->view = new ProductView();
$this->model = new ProductModel();
}

public function displayProducts()
{
$products = $this->model->get();
$this->view->products($products);
}
}
```

# Routing
Previously we had a terrible routing system in which we required our routes to be named after files and in order to go to other routes we had to call something like example.com/ControllerName/ControllerFunction

but what it was actually doing was calling the view functions instead of a controller function  which was incorrect. The new routing system takes car of this for us. I will be submitting to my branch for review

in the index.php file declare your routes like so
```php
//The slash here is the name of the route example.com/
// IndexController is the class its going to call
// index is the function
$router->addRoute("/","IndexController","index");

//The index in the first parameter here is the name of the route example.com/index
//IndexController is the class its going to call
// index is the function
$router->addRoute("index","IndexController","index");
```

If you need the same route for multiple controllers you would use the same name for both when
you add the route like so

```php
// This routes to the pages example.com/products
// call the Products Controller class displayProducts function
$router->addRoute("products","ProductController","displayProducts");
// This also routes to the pages example.com/products
// call the CategoryController class displayCategory function
$router->addRoute("products","CategoryController","displayCategory");
```
There is a last parameter which is an array which is optional
It acts as middleware and routes users to a forbidden page
if they don't meet the requirement for that page
say there user_type = 4 but the page only allows user_types 1,2,and 3
you would define it like so in your route
```php
$router->addRoute("route","Controller","function",array(1,2,3));
```
This would forbid that user from accessing that controller and function

# Routing GETS and POSTS and Re-Routing
In order to do pass parameter from a GET request to a function make sure they are in the correct order you want to accept them defined in the parameters the routing system will automatically pass the parameters you may just have to do some definitions in your html code when necessary.

Example this is in pages/category/categories.php
notice we pass the category id to the route ./products as id = $c->CategoryID
```php
<div class="sidenav">
<?php
foreach ($categories as $c)
{
echo '<a href=./products?id='. $c->CategoryID.'>'.$c->CategoryName."</a>";
}

?>
</div>

```

since the route $router->addRoute("products","ProductController","displayProducts"); was defined in index.php the parameter id will be passed to the displayProducts function

This code roughly translates to if no id was passed display all products if an id was passed from
clicking a category we call the where statement and pass those as the products
```php

public function displayProducts($id=null)
{
if($id == null)
{
$products = $this->model->get();
$this->view->products($products);
}
else
{
$products = $this->model->where('CategoryID', '=', $id)->get();
$this->view->products($products);
}
}
```

Gets and Posts from a form don't need you to explicitly declare the ?parameter name after the route

for example our login notice the form action is defined as ./logginin the method is a post
to define parameter just set the name="parameter" for each input
```html
<div class="container">
<div class="brand-box">
Elegant E-Commerce Store Login
</div>
<div class="row">
<div class="col">
<form action="./loggingin" method="post">
<div class="form-group">
<input name="user_name" type="text" class="form-control fc" placeholder="username" required>
</div>
<div class="form-group">
<input name="password" type="password" class="form-control fc" placeholder="password" required>
</div>

<?php
if(isset($_SESSION["login_error"]))
{

echo '<p style="color:#DC143C;">'. $_SESSION["login_error"][0]. '</p>';

unset($_SESSION["login_error"]);
}

?>

<div class="checkbox">
<label>
<input name="remember_me" type="checkbox"> Remember me
</label>
<input  type="hidden" value="No" name="remember_me">
</div>
<button type="submit" class="btn btn-primary">Sign in</button>
</form>
</div>
<div class="col">
<form action="./register" method="get">
<button class="btn btn-lg btn-primary btn-block" type="submit">
Create an account
</button>
</form>
</div>
</div>
</div>
```

declare your function with the input in the correct order in order for it to properly pass through and not give you any confusion as to what parameter it was suppose to be

```php

public function login($username,$password,$rememberme)
{

if(!isset($_SESSION['user_name']))
{
if(!$this->model->loginWithPostData($username, $password, $rememberme))
{
$_SESSION["login_error"] = $this->model->errors;
header('Location: ./login');
}else{

header('Location: ./dashboard');
}
}
}
```

if you need to call a function just once you can reroute to a page after you've completed what ever you needed to in the controller function

the original route that called this was
$router->addRoute("loggingin","UserController","login");

notice the header('Location: ./login') will either take us back to the login page if there was an error

Login route defined as: $router->addRoute("login","UserController","displayLogin");

or successfully take us to the dashboard ('Location: ./dashboard').
dashboard route was defined as :
$router->addRoute("dashboard","UserController","displayDashboard");

```php

public function login($username,$password,$rememberme)
{

if(!isset($_SESSION['user_name']))
{
if(!$this->model->loginWithPostData($username, $password, $rememberme))
{
$_SESSION["login_error"] = $this->model->errors;
header('Location: ./login');
}else{

header('Location: ./dashboard');
}
}
}
```

# Adding Views to main layout
Create a folder in the pages folder for your class in this example it will be Category classes

pages/classname/classfunction.php

populate this with mixed html php code.
example is in pages/category/categories.php
```html
<div class="sidenav">
<?php
foreach ($categories as $c)
{
echo '<a href=./products?id='. $c->CategoryID.'>'.$c->CategoryName."</a>";
}

?>
</div>
```
## ALWAYS CONCATENATE TO SESSION CONTENT!!!
require_once 'pages/classname/classfunction.php'
require_once 'layout.html' this will add to content to the layout

```php
public function categories($categories)
{
require_once 'pages/templates/header.php';    require_once 'pages/category/categories.php';
require_once 'pages/templates/footer.php';
}

```

another example passing a parameter from the view class to the html page

```php
public function products($products)
{

require_once 'pages/templates/header.php';    require_once 'pages/product/products.php';
require_once 'pages/templates/footer.php';
}
```
The function parameter $products is pass into the html page  'pages/product/products.php';
``` html
<div class="container dp">
<?php
foreach ($products as $p) {
echo '<div class="row"><p>'.$p->ProductName."</p>
<p>".$p->SupplierID ."</p>
<p>".$p->CategoryID ."</p>
<p>".$p->Unit ."</p>
<p>".$p->Price ."</p></div>";
}
?>
</div>
```



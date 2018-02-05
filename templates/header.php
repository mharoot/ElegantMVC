<?php
$url = $_SERVER['REQUEST_URI']; //returns the current URL
$parts = explode('/',$url);
$dir = $_SERVER['SERVER_NAME'];
$i = 0;
while( ( $i < count($parts) ) && ($parts[$i] != 'ElegantMVC') ) {
  $dir .= $parts[$i] . "/";
  $i++;
}
$base_url = "http://$dir/ElegantMVC/";    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Elegant MVC</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo $base_url;?>assets/css/prism.css">
  <link rel="stylesheet" href="<?php echo $base_url;?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $base_url;?>assets/css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="<?php echo $base_url;?>assets/js/customScrollEvents.js"></script>
</head>
<body>
<nav id="navbar" class="container-fluid navbar navbar-toggleable-md navbar-light bg-faded">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href=".">Elegant</a>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo $base_url;?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Documentation
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="./model">Model</a>
          <a class="dropdown-item" href="./queryBuilder">Query Builder</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
</br>
</br>
</br>
</br>

<!-- <div class="container-fluid">
<div class="row"> -->

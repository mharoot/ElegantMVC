<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/layout.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/prism.css">
  </head>
  <body>
  <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top navbar-dark bg-company">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="./login">Elegant Store</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php echo ($_SESSION['page'] == "index" || $_SESSION['page'] == "/" ? "active" : "")?>">
        <a class="nav-link" href="./login">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php echo ($_SESSION['page'] == "login" || $_SESSION['page'] == "dashboard" ? "active" : "")?>">
        <a class="nav-link" href="./login"> Login </a>
      </li>
      <li class="nav-item <?php echo ($_SESSION['page'] == "products" ? "active" : "")?>">
        <a class="nav-link" href="./products"> Products </a>
      </li>
      <?php 
        if($_SESSION["authorization"] == 2) 
        {
      
      echo 
      '<li class="nav-item ' . ($_SESSION["page"] == "review-billing-information" ? "active" : "") . '">
        <a class="nav-link" href="./review-billing-information"> Billing Info </a>
      </li>';
     
        }
      ?>
      <li class="nav-item <?php echo ($_SESSION['page'] == "about-model" || $_SESSION['page'] == "about-query-builder" ? "active" : "")?> dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Documentation
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="./about-model"> Model </a>
          <a class="dropdown-item" href="./about-query-builder">Query Builder</a>
        </div>
      </li>
</div>
    </ul>
    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2 fc" onkeyup="searchProducts(this.value)" type="text" placeholder="Product Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        <p style="color: #FFFFFF ! important">Suggestions: <span id="txtHint"></span></p>
      </form>
  </div>
</nav>

    <div class="container">
    <div class="row">
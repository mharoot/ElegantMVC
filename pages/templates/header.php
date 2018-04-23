
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
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>

  </head>
<body>
<header style=" width:100%;padding:10px 0;">
  <nav class="navbar fixed-top navbar-toggleable-md navbar-inverse navbar-dark bg-company">

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
     
     
      </ul>



      <ul class="navbar-nav pull-right">

      <li class="nav-item">
        <form action="./select" method="GET" id="searchForm" class="form-inline">
         
        <div class="form-group mydropdown-content" style="right: 32%">
          <input type="text" class="form-control " placeholder="Search.." id="myInput" onkeyup="searchProducts(this.value)" autocomplete="off" placeholder="Search...">

          </input>
          
          <div id="txtHint">
          
          </div>
          <input id="formInput" type="hidden" name="q"> 

          </input>

         </div>

          
        </form>
          

      </li>



      <li class="nav-item">
      <form action ="./cart">
        <button style="background: #316884 ;color: white; border: 1px solid;">
        <i class="fas fa-shopping-cart fa-2x"> </i>
        Cart
        </button>
      </form>
      </li>
       <li class="nav-item">
       <form action='./wishlist'>
        <button style="background: #316884 ;color: white; border: 1px solid;">
        <i class="fas fa-heart fa-2x"> </i>
        Wishlist
        </button>
      </form>
      </li>
       <li class="nav-item">
        <form action="./login">
        <button style="background: #316884 ;color: white; border: 1px solid;">
        <i class="fas fa-cog fa-2x"> </i>
        Account
        </button>
        </form>
      </li>
    </ul>
</div>
  
   
  
</nav>
</header>

    <div class="container" style="padding: 5%; padding-top: 10%">
    <div class="row" id="products">
<?php
  ob_start();
  session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Market</title>
  <link rel="stylesheet" href="./css/bootstrap-4/css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  <div class="menu">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <div class="div d-flex m-auto">
          <a class="navbar-brand" href="index.php">Market online</a>
          <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="index.php?tab=vegetable">Vegetable</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?tab=cart">Cart</a>
              </li>
              <?php
                if (!isset($_SESSION['CustomerID'])){
                  
              ?>
              <li class="nav-item">
                <a class="nav-link" href="index.php?tab=login">Login</a>
              </li>
              <?php
                } else {
              ?>
              <li class="nav-item">
                <a class="nav-link" href="index.php?tab=history">History</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?tab=logout">Logout</a>
              </li>
              <li class="nav-item bg-info rounded position-relative option">
                <span class="nav-link text-dark"><?=$_SESSION['Fullname']?></span>
                <ul class="position-absolute custom">
                  <li>
                    <a href="#" class="color-new"><span class="" >Category</span></a>
                    <a href="index.php?tab=new_category" class="color-new"><span class="" >NEW</span></a>
                  </li>
                  <li>
                    <a href="#" class="color-new"><span>Vegetable</span></a>
                    <a href="index.php?tab=new_vegetable" class="color-new"><span>NEW</span></a>
                  </li>
                  <li>
                    <a href="#" ><span>Of Me</span></a>
                    <a href="index.php?tab=history" ><span>HISTORY</span></a>
                  </li>
                </ul>
              </li>

              <?php
                }   
              ?>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <?php
      $tab = '';
      if (isset($_GET['tab'])){
        $tab = $_GET['tab'];
      }
    
      switch ($tab){
        case 'login':
          require_once('./customer/login.php');
          break;
        
        case 'logout':
          require_once('./customer/logout.php');
          break;

        case 'register':
          require_once('./customer/register.php');
          break;
    
        case 'vegetable':
          require_once('./vegetable/index.php');
          break;
        
        case 'cart':
          require_once('./cart/index.php');
          break;
    
        case 'history':
          require_once('./cart/history.php');
          break;
    
        case 'detail':
          require_once('./cart/detail.php');
          break;

        case 'new_category':
          require_once('./category/index.php');
          break;

        case 'new_vegetable':
          require_once('./vegetable/new.php');
          break;
        default:
          require_once('index.php');
      }  
    ?>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="./js/ajax.js"></script>
</body>
</html>
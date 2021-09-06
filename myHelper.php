<?php
  session_start();
  function isNotEmpty($input){
    $strTemp = $input;
    $strTemp = trim($strTemp);

    if ($strTemp != ''){ // Tương tự "if (strlen($strTemp) > 0)"
      return true;
    } 

    return false;
  }

  // ajax
  if (isset($_POST['action'])){
    $action = $_POST['action'];

    switch ($action) {
      case 'addToCart':
        $id = $_POST['id'];
        if (isset($_SESSION['cart'][$id])){
          $_SESSION['cart'][$id] = $_SESSION['cart'][$id] + 1;
        }else{
          $_SESSION['cart'][$id] = 1; 
        }
        echo "Thêm thành công";
        break;

    }
    
  }


?>
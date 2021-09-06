<?php
  session_start();
  require_once('../connection.php');
  require_once('../class/order.php');
  require_once('../class/vegetable.php');
  
  
  if (isset($_POST['totals'])) {
    
    if (isset($_SESSION['CustomerID']) && isset($_SESSION['Password'])) {
      $totals = $_POST['totals'];
      $note = '';
      $newOrder = new order();

      $idNew = $newOrder->getIDNew();
            
      // create datetime
      date_default_timezone_set("Asia/Ho_Chi_Minh");
      $createDate = date('Y-m-d');
      // echo gettype($createDate);die();

      $newOrder->setOrder($idNew, $_SESSION['CustomerID'], $createDate, $totals, $note);
      $newOrder->addOrder($newOrder);
      $listItemOfCart = $_SESSION['cart'];
      
      foreach ($listItemOfCart as $id => $quantity) {
        $veg = new vegetable();

        $num = $veg->getByID($id);
        
        $newOrder->setDetail($idNew, $id, $quantity, $num['Price']);
        $newOrder->addDetail($newOrder);

        $updateQty = $num['Amount'] - $quantity;
        $veg->updateQtyVegetable($id, $updateQty);
      }

      unset($_SESSION['cart']);

      echo "Đặt hàng thành công";

    } else {
      echo "Vui lòng đăng nhập";
    }
  }
  
?>
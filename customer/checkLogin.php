<?php
  session_start();
  
  require_once('../class/customer.php');
  if (!empty($_POST['cusid'])){
    $cusid = $_POST['cusid'];
    $password = $_POST['password'];

    if (isset($cusid) && isset($password)){
        $cus = new customer();

        $cus = $cus->getByID($cusid);
        if (count($cus) > 0 && $password === $cus['Password']){
          $_SESSION['CustomerID'] = $cusid;
          $_SESSION['Password'] = $password;
          $_SESSION['Fullname'] = $cus['Fullname'];
          $_SESSION['Address'] = $cus['Address'];
          $_SESSION['City'] = $cus['City'];
        } else {
          echo "Lỗi đăng nhập không đúng";
        }
    }
  }
?>
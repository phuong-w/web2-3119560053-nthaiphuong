<?php
  require_once('../class/customer.php');
  require_once('../myHelper.php');

  if (!empty($_POST['fullname'])){
    $fullname = '';
    $password = '';
    $address = '';
    $city = '';

    if(isset($_POST['fullname'])){
      $fullname = $_POST['fullname'];
    }
    
    if(isset($_POST['password'])){
      $password = $_POST['password'];
    }

    if(isset($_POST['address'])){
      $address = $_POST['address'];
    }

    if(isset($_POST['city'])){
      $city = $_POST['city'];
    }

    // Nếu không là giá trị rỗng kể cả ký tự khoảng trắng
    if (isNotEmpty($fullname) && isNotEmpty($password)
    && isNotEmpty($address) && isNotEmpty($city)){
      $cus = new customer();
      $cus->setAll($fullname, $password, $address, $city);
      $cus->add($cus); // Thực hiện câu truy vấn vào database
      echo "Tạo thành công";
    } else {
      echo "Không thành công";
    }
    
  }
?>
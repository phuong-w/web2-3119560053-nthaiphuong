<?php
  require_once('../class/vegetable.php');
  require_once('../myHelper.php');

  if (!empty($_POST['fileSize'])){
    $fileSize = $_POST['fileSize'];
    // Kiểm tra tối đa file là 2MB
    $convert = 1048576;
    $fileSize = $fileSize/$convert;

    if ($fileSize < 2) {
      $vegName = '';
      $unit = '';
      $amount = '';
      $price = '';
      $cateId = '';
      $fileName = '';

      if(isset($_POST['vegName'])){
        $vegName = $_POST['vegName'];
      }
      
      if(isset($_POST['unit'])){
        $unit = $_POST['unit'];
      }

      if(isset($_POST['amount'])){
        $amount = $_POST['amount'];
      }

      if(isset($_POST['cateID'])){
        $cateID = $_POST['cateID'];
      }

      if(isset($_POST['price'])){
        $price = $_POST['price'];
      }

      if(isset($_POST['fileName'])){
        $fileName = $_POST['fileName'];
      }

      $veg = new vegetable();
      $veg->createVegetable($cateID, $vegName, $unit, $amount, $fileName, $price);

      echo "Thêm thành công";

    } else {
      echo "Kích thước file tối đa là 2MB";
    }
    
  }
?>
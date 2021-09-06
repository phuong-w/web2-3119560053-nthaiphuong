<?php
  require_once('../connection.php');
  require_once('../class/category.php');
  require_once('../myHelper.php');

  if (isset($_POST['name']) && isset($_POST['description'])){
    $name = $_POST['name'];
    $description = $_POST['description'];

    if (isNotEmpty($name) && isNotEmpty($description)){
      $cate = new category();
      $cate->setAll($name, $description);
      $cate->add($cate);
      echo "Thêm thành công";
    } else {
      echo "Thêm thất bại";
    } 
  } else {
    echo "Vui lòng nhập đủ các trường";
  }

?>
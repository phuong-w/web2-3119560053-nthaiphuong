<?php
  
  if (file_exists('../connection.php')){
    require_once ('../connection.php');
  } else {
    require_once ('./connection.php');
  }
class vegetable {
  private $vegetableID;

  function getVegetableId(){
    return $this->vegetableID;
  }

  // Lấy tất cả sản phẩm
  function getAll() {
    $sql = "SELECT * FROM vegetable";
    $result = executeResult($sql);
    if (!empty($result)){
      return $result;
    } else {
      return "Không có dữ liệu!";
    }
  }

  // Lấy nhiều sản phẩm theo ids
  function getListByIds($ids){
    $ids = implode(',',$ids);
    $sql = "SELECT * FROM vegetable WHERE VegetableID in (${ids})";
    $result = executeResult($sql);
    if (!empty($result)){
      return $result;
    } else {
      return [];
    }
  }

  // Update số lượng hàng hoá
  function updateQtyVegetable($id, $quantity){
    $sql = "UPDATE `vegetable` SET `Amount`='$quantity' WHERE VegetableID = ${id}";
    execute($sql);
  }

  

  //Lấy tất cả sản phẩm thuộc 01 danh mục (category)
  function getListByCateID($cateid) {
    $sql = "SELECT * FROM vegetable WHERE CategoryID = ${cateid}";
    $result = executeResult($sql);
    if (!empty($result)){
      return $result;
    } else {
      return "Không có dữ liệu!";
    }
  }

  //Lất tất cả sản phẩm thuộc nhiều danh mục
  function getListByCateIDs($cateids){
    $cateids = implode(',',$cateids);
    $sql = "SELECT * FROM vegetable WHERE CategoryID in (${cateids})";
    $result = executeResult($sql);
    if (!empty($result)){
      return $result;
    } else {
      return [];
    }
  }

  //Lấy chi tiết sản phẩm theo khóa chính 
  function getByID($vegetableID){
    $sql = "SELECT * FROM vegetable WHERE VegetableID = ${vegetableID}";
    $result = executeSingleResult($sql);
    if (!empty($result)){
      return $result;
    } else {
      return "Không có dữ liệu!";
    }
  }

  function createVegetable($categoryId, $vegName, $unit, $amount, $image, $price) {
    $image_src = 'images/'.$image;
    $sql = "INSERT INTO `vegetable`(`CategoryID`, `VegetableName`, `Unit`, `Amount`, `Image`, `Price`) VALUES ('$categoryId','$vegName','$unit','$amount',' $image_src','$price')";
    execute($sql);
  }

}

?>
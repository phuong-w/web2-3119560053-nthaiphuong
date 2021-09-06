<?php
  if (file_exists('../connection.php')){
    require_once ('../connection.php');
  } else {
    require_once ('./connection.php');
  }

  class category {
    private $name;
    private $description;

    function setAll($name, $description){
      $this->name = $name;
      $this->description = $description;
    }

    function getName(){
      return $this->name;
    }

    function getDescription(){
      return $this->description;
    }

    // Lấy tất cả danh mục
    function getAll() {
      $sql = "SELECT * FROM category ORDER BY CategoryID DESC";
      $result = executeResult($sql);
      if (!empty($result)){
        return $result;
      } else {
        return [];
      }
    }

    // Thêm mới một danh mục
    function add($cate){
      $name = $cate->getName();
      $description = $cate->getDescription();

      $sql = "INSERT INTO `category`(`Name`, `Description`) VALUES ('$name','$description')";
      execute($sql);
    }
  }
?>
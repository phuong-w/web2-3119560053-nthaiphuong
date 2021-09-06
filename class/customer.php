<?php
  if (file_exists('../connection.php')){
    require_once ('../connection.php');
  } else {
    require_once ('./connection.php');
  }

  class customer {
    private $fullname;
    private $password;
    private $address;
    private $city;

    function setFullname($fullname) {
      $this->fullname = $fullname;
    }

    function setPassword($password) {
      $this->password = $password;
    }

    function setAddress($address) {
      $this->address = $address;
    }

    function setCity($city) {
      $this->city = $city;
    }

    function setAll($fullname, $password, $address, $city){
      $this->fullname = $fullname;
      $this->password = $password;
      $this->address = $address;
      $this->city = $city;
    }

    function getFullName() {
      return $this->fullname;
    }

    function getPassword() {
      return $this->password;
    }

    function getAddress() {
      return $this->address;
    }

    function getCity() {
      return $this->city;
    }
    

    // Lấy thông tin khách hàng theo ID
    function getByID($cusid){
      $sql = "SELECT * FROM customers WHERE CustomerID = ${cusid}";
      $result = executeSingleResult($sql);
      //empty() xác định xem 1 biến có rỗng hay không? rỗng -> true
      //isset() xác định xem 1 biến đã khai báo chưa, khác null
      if (empty($result)){
        return [];
      } else {
        return $result;
      }
    }

    // Thêm mới thông tin của một khách hàng
    function add($cus){
      $password = $cus->getPassword();
      $fullname = $cus->getFullName();
      $address = $cus->getAddress();
      $city = $cus->getCity();

      $sql = "INSERT INTO `customers`(`Password`, `Fullname`, `Address`, `City`) VALUES ('$password','$fullname','$address','$city')";
      execute($sql);
    }
    
  }
?>
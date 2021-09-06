<?php
  if (file_exists('../connection.php')){
    require_once('../connection.php');
  } else {
    require_once('./connection.php');
  }

  class order{
    private $orderId;
    private $customerId;
    private $date;
    private $total;
    private $note;
    private $vegetableId;
    private $quantity;
    private $price;

    function getOrderId(){
      return $this->orderId;
    }

    function getCustomerId(){
      return $this->customerId;
    }

    function getDate(){
      return $this->date;
    }

    function getTotal(){
      return $this->total;
    }

    function getNote(){
      return $this->note;
    }

    function getVegetableId(){
      return $this->vegetableId;
    }


    function getQuantity(){
      return $this->quantity;
    }

    function getPrice(){
      return $this->price;
    }

    function setOrder($orderId, $customerId, $date, $total, $note){
      $this->orderId = $orderId;
      $this->customerId = $customerId;
      $this->date = $date;
      $this->total = $total;
      $this->note = $note;
    }

    function setDetail($orderId, $vegetableId, $quantity, $price){
      $this->orderId = $orderId;
      $this->vegetableId = $vegetableId;
      $this->quantity = $quantity;
      $this->price = $price;
    }

    function getIdNew() {
      // Truy xuất đến sô id cuối cùng hiện tại của bảng
      $sql = "SELECT * FROM `order`";
      $idnew = executeTotalRowsResult($sql);
      if ($idnew) {
        return $idnew;
      }
      return "Dữ liệu rỗng";
    }

    
    // Lấy tất cả thông tin hoá đơn của một khách hàng
    function getAllOrder($cusID){
      $sql = "SELECT * FROM `order` as o WHERE CustomerID = ${cusID}";
      $result = executeResult($sql);
      if ($result) {
        return $result;
      }
      return "Dữ liệu rỗng";
    }

    // Lấy tất cả thông tin chi tiết hoá đơn theo OrderID
    function getOrderDetail($orderid){
      $sql = "SELECT * FROM orderdetail WHERE OrderID = ${orderid}";
      $result = executeResult($sql);
      if ($result) {
        return $result;
      }
      return [];
    }

    /**
     * orderdetail(OrderID, VegetableID, Quantity, Price)
     * order(OrderID, CustomerID, Date, Total, Note)
     */
    // Hàm thêm mới thông tin hoá đơn và chi tiết hoá đơn
    function addOrder($order){
      $orderId = $order->getOrderId();
      $customerId = $order->getCustomerId();
      $date = $order->getDate();
      $total = $order->getTotal();
      $note = $order->getNote();
      
      $sqlOrder = "INSERT INTO `order`(`OrderID`, `CustomerID`, `Date`, `Total`, `Note`) VALUES ('$orderId','$customerId',DATE('$date'),'$total','$note')";
      execute($sqlOrder);
    }

    function addDetail($detail){
      $orderId = $detail->getOrderId();
      $vegetableId = $detail->getvegetableId();
      $quantity = $detail->getQuantity();
      $price = $detail->getPrice();
      
      $sqlDetail = "INSERT INTO `orderdetail`(`OrderID`, `VegetableID`, `Quantity`, `Price`) VALUES ('$orderId','$vegetableId','$quantity','$price')";
      execute($sqlDetail);
    }
  }
?>
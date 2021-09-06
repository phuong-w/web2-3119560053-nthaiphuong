<?php
session_start();

if (isset($_SESSION['CustomerID'])){
  unset($_SESSION['CustomerID']);
  header('Location: index.php');
}else{
  header('Location: index.php');
}
?>
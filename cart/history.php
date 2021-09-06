<?php
  require_once('./class/order.php');
  if (isset($_SESSION['CustomerID']) && isset($_SESSION['Password'])) {
    $id = $_SESSION['CustomerID'];

    $cusOrder = new order();
    // $sql = "SELECT * FROM `order` as o WHERE CustomerID = '$id' ORDER BY o.Date DESC";

    $historyBuy = $cusOrder->getAllOrder($id);
    if (count($historyBuy) > 0){
      // echo ($historyBuy > 0);die();

?>
<div class="container mt-5 cart">
    <div class="row p-4">
      <h3>History</h3>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Date</th>
              <th scope="col">Total</th>
              <th scope="col">Detail</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $i = 1;
              foreach ($historyBuy as $item){

            ?>
            <tr>
              <th scope="row"><?php echo $i++;?></th>
              <td><?=$item['Date']?></td>
              <td><?=$item['Total']?></td>
              <td>
                <a href="index.php?tab=detail&s=<?=$item['OrderID']?>" class="btn btn-info">Detail</a>
              </td>
            </tr>
            <?php
              }
            ?>
          </tbody>
        </table>
    </div>
</div>
<?php
  } else {
    echo "<script>
    alert('Chưa có thông tin mua hàng');
    location.replace('index.php?tab=vegetable');
    </script>";
  }
} else {
  echo "<script>
  alert('Vui lòng đăng nhập');
  location.replace('index.php?tab=vegetable');
  </script>";
}
?>
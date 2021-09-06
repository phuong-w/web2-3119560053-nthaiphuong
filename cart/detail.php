<?php
  require_once('./connection.php');
  if (isset($_SESSION['CustomerID']) && isset($_SESSION['Password'])) {
    if (isset($_GET['s'])){
    
      $orderId = $_GET['s'];
      $sql = "SELECT v.VegetableName, v.Image, d.Quantity, v.Price FROM `orderdetail` as d JOIN `vegetable` as v ON d.VegetableID = v.VegetableID WHERE d.OrderID = $orderId ";

      $detailList = executeResult($sql);

?>
<div class="container mt-5 cart mb-5">
    <div class="row p-4">
      <h3>Order detail</h3>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Picture</th>
              <th scope="col">Amount</th>
              <th scope="col">Price</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $total = 0;
            $countQty = 0;
            foreach($detailList as $detailItem) {
              $total += $detailItem['Price'] * $detailItem['Quantity'];
              $countQty += $detailItem['Quantity'];
            }
            // echo $total;die();
            foreach($detailList as $detailItem) {
            ?>
            <tr>
              <th scope="row">1</th>
              <td>Potato</td>
              <td>
                <img src="<?=$detailItem['Image']?>" alt="" style="width:175px">
              </td>
              <td><?=$detailItem['Quantity']?></td>
              <td><?=$detailItem['Price']?></td>
            </tr>
            <?php
              }
            ?>
            </tr>
              <th>Total</th>
              <td></td>
              <td></td>
              <td><?=$countQty?></td>
              <td><?=$total?></td>
            <tr>
          </tbody>
        </table>
    </div>
</div>
<?php
  }
}
?>
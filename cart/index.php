<?php
  if (file_exists('../class/vegetable.php')){
    require_once ('../class/vegetable.php');
  } else {
    require_once ('./class/vegetable.php');
  }
  
  if (isset ($_SESSION['cart']) && $_SESSION['cart'] > 0) {
    $arrayId = [];
    
    foreach ($_SESSION['cart'] as $id => $quantity) {
      $arrayId[] = $id;
    }  
    
    $veg = new vegetable();

    $listVeg = $veg->getListByIds($arrayId);
  
?>
  <div class="container mt-5 cart">
    <form action="POST">
      <div class="row p-4">
        <h3>Cart</h3>
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
                foreach($listVeg as $veg) {
                  if ($veg['Amount'] > 0) {
              ?>
              <tr>
                <th scope="row">1</th>
                <td><?=$veg['VegetableName']?></td>
                <td>
                  <img src="<?=$veg['Image']?>" alt="" style="width:175px">
                </td>
                <td><?php if(isset($_SESSION['cart'][$veg['VegetableID']])){
                  echo $_SESSION['cart'][$veg['VegetableID']];
                  }?></td>
                <td><?=$veg['Price']?></td>
              </tr>
              <?php
                  }
                }
              ?>
              </tr>
                <th>Total</th>
                <td></td>
                <td></td>
                <?php
                  $countQty = 0;
                  $totals = 0;
                  foreach($listVeg as $veg){
                    $countQty += $_SESSION['cart'][$veg['VegetableID']];
                    $totals += $veg['Price'] * $_SESSION['cart'][$veg['VegetableID']];
                  }
                ?>
                <td><?=$countQty?></td>
                <td><?=$totals?></td>
              <tr>
            </tbody>
          </table>
          <a onclick="orderCart(<?=$totals?>)" class="btn btn-danger text-white">Order</a>
      </div>
    </form>
  </div>
<?php
  } else {
    echo "<script>
        alert('Giỏ hàng của bạn đang trống')
        location.replace('index.php?tab=vegetable');
    </script>";
}
?>
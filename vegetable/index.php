<?php
  require_once('./connection.php');
  require_once('./class/vegetable.php');
  require_once('./class/category.php');
?>
  <div class="container mt-5">
    <div class="row">
      <div class="col-3">
        <h3 class="title-header">Category Name:</h3>
        <?php
            $cate = new category();
            $listCate = $cate->getAll();
            if (count($listCate) > 0){
              foreach ($listCate as $itemCate){ 
          ?>
        <form method="POST" action="" id="filter">
            <div class="custom-control custom-checkbox form-group">
              <input type="checkbox" value="<?=$itemCate['CategoryID']?>" rules="required" name="checkList[]" class="custom-control-input form-control" id="checkList[<?=$itemCate['CategoryID']?>]">
              <label class="custom-control-label form-label" for="checkList[<?=$itemCate['CategoryID']?>]"><?=$itemCate['Name']?></label>
              <span class="form-message"></span>
            </div>
          <?php 
                }
              }
          ?>
          <input type="submit" name="btnSubmit" class="btn btn-info mt-5" value="Filter">
        </form>
      </div>
      <div class="col-9">
        <div class="container pb-5">
          <h2 class="tab-name">Vegetable</h2>
          <div class="row row-product">
          <?php
            $veg = new vegetable();
            $listVeg = [];
            if (isset($_POST['btnSubmit'])){
              if(isset($_POST['checkList'])) {
                $cateids = [];
                $checkList = $_POST['checkList'];
                foreach ($checkList as $value){
                  $cateids[] = $value;
                }
                $listVeg = $veg->getListByCateIDs($cateids);
              } else {
                $listVeg = $veg->getAll();
              }
            } else {
              $listVeg = $veg->getAll();
            }

            if (count($listVeg) > 0){
              foreach ($listVeg as $itemVeg){ 
          ?>
            <div class="col col-product mt-5">
              <div class="d-block w-100" style="min-height: 175px">
                <img src="<?=$itemVeg['Image']?>" alt="" class="rounded" style="width:175px; object-fit: center">
              </div>
              <div>
                <h3 class="vegetable-name"><?=$itemVeg['VegetableName']?></h3>
                <span class="btn btn-warning text-white price"><?=$itemVeg['Price']?></span>
              </div>
              <span onclick="addToCart('<?=$itemVeg['VegetableID']?>')" class="btn btn-danger buy mt-2">Buy</span>
            </div>
            <?php 
                }
              } else {
                echo "Không có sản phẩm";
              }
          ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  

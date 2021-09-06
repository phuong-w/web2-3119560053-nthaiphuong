<?php
  require_once('./connection.php');
  require_once('./class/vegetable.php');
  require_once('./class/category.php');
  if (isset($_SESSION['CustomerID']) && isset($_SESSION['Password'])) {

    $cate = new category();
    $cateList = $cate->getAll();

?>
<div class="container mt-5 cart">
  <h3 class="m-4">Add Vegetable</h3>
  <form method="POST" enctype="multipart/form-data" id="add-vegetable-form">
    <div class="row p-4">
      <div class="col-8">
        <div class="form-group">
          <label for="vegName" class="form-label">Vegetable Name:</label>
          <input type="text" id="vegName"  rules="required" name="vegName" class="form-control">
          <span class="form-message"></span>
        </div>
        <div class="row">
          <div class="form-group col">
            <label for="unit" class="form-label">Unit:</label>
            <select name="unit" id="unit" rules="required|select" class="form-control">
              <option value="" name="unitOption">__Chọn một đơn vị__</option>
              <option value="kg" name="unitOption">Kg</option>
              <option value="bag" name="unitOption">Bag</option>
              <option value="per fruit" name="unitOption">Per fruit</option>
              <option value="bunch" name="unitOption">Bunch</option>
            </select>
            <span class="form-message"></span>
          </div>
          <div class="form-group col">
            <label for="amount" class="form-label">Amount:</label>
            <input type="text" id="amount" rules="required|number" name="amount" class="form-control">
            <span class="form-message"></span>
          </div>
        </div>
        <div class="form-group">
          <label for="image" class="form-label">Image:</label>
          <input type="file" accept=".png, .jpg, .jpeg" id="file" rules="file" name="file" class="form-control">
          <span class="form-message"></span>
        </div>
        <input type="submit" name="btnCreateVegetable" class="btn btn-info" value="Add">
      </div>
      <div class="col-4">
        <div class="form-group">
          <label for="cateID" class="form-label">Category Name:</label>
          <select name="cateID" id="cateID" rules="required|select" class="form-control">
            <option value="" name="optionName">__Chọn một danh mục__</option>
            <?php
            foreach($cateList as $cateItem) {
            ?>
            <option value="<?=$cateItem['CategoryID']?>" name="optionName"><?=$cateItem['Name']?></option>
            <?php
            }
            ?>
          </select>
          <span class="form-message"></span>
        </div>
        <div class="form-group">
          <label for="price" class="form-label">Price:</label>
          <input type="text" id="price" rules="required|number" name="price" class="form-control">
          <span class="form-message"></span>
        </div>
      </div>
    </div>
  </form>
</div>
<script src="./js/validator.js"></script>
<script>

    const inputElement = document.querySelector('input[name="file"]')
    var formRegister = new Validator('#add-vegetable-form')
    formRegister.onSubmit = function (formData){
      $.post('./vegetable/add.php', {
        'vegName': formData['vegName'],
        'unit': formData['unit'],
        'amount': formData['amount'],
        'price': formData['price'],
        'cateID': formData['cateID'],
        'fileSize': formData['file'],
        'fileName': inputElement.files[0].name

      },function(data){
        if(data){
          alert(data)
          location.reload()
        }
      })
    }
  </script>
<?php
  }
?>
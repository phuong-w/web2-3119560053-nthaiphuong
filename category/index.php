<?php
  require_once('./connection.php');
  require_once('./class/category.php');
  if (isset($_SESSION['CustomerID']) && isset($_SESSION['Password'])) {

    $cate = new category();
    $cateList = $cate->getAll();

?>
<div class="container mt-5 cart">
    <div class="row p-4">
      <div class="col-4">
        <form method="POST" class="mt-3" id="add-category-form">
          <div class="form-group">
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" name="name" rules="required" class="form-control">
            <span class="form-message"></span>
          </div>
          <div class="form-group">
            <label for="discription" class="form-label">Discription:</label>
            <input type="text" id="description" name="description" rules="required" class="form-control">
            <span class="form-message"></span>
          </div>
          <button class="btn btn-info">Add</button>
        </form>
      </div>
      <div class="col-8">
        <h3>Category</h3>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
              foreach($cateList as $cate){
            ?>
            <tr>
              <th scope="row"><?=$i++;?></th>
              <td><?=$cate['Name']?></td>
              <td><?=$cate['Description']?></td>
            </tr>
            <?php
              }
            ?>

          </tbody>
        </table>
      </div>
    </div>
</div>
<script src="./js/validator.js"></script>
<script type="text/javascript">
  var formRegister = new Validator('#add-category-form')
  formRegister.onSubmit = function (formData){
      $.post('./category/add.php', {
        'name': formData['name'],
        'description': formData['description']

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
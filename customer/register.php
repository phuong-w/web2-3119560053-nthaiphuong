<?php 
  if (!isset($_SESSION['CustomerID'])){
?>
  <div class="main">
    <form action="" method="POST" class="form" id="register-form">
      <h3 class="heading">Register</h3>
      <div class="spacer"></div>
      <div class="form-group">
        <label for="fullname" class="form-label">Your's Fullname:</label>
        <input id="fullname" name="fullname" rules="required" type="text" class="form-control">
        <span class="form-message"></span>
      </div>

      <div class="form-group">
          <label for="password" class="form-label">Password</label>
          <input id="password" name="password" rules="required|min:6" type="password" class="form-control">
          <span class="form-message"></span>
      </div>

      <div class="form-group">
        <label for="address" class="form-label">Address:</label>
        <input id="address" name="address" rules="required" type="text" class="form-control">
        <span class="form-message"></span>
      </div>

      <div class="form-group">
        <label for="city" class="form-label">City:</label>
        <input id="city" name="city" rules="required" type="text" class="form-control">
        <span class="form-message"></span>
      </div>

      <button class="form-submit btn btn-info text-white">Register</button>
    </form>
  </div>
  <script src="./js/validator.js"></script>
  <script>

    var formRegister = new Validator('#register-form')
    formRegister.onSubmit = function (formData){
      $.post('./customer/saveRegister.php', {
        'fullname': formData['fullname'],
        'password': formData['password'],
        'address': formData['address'],
        'city': formData['city'],

      }, function(data) {
          if(data){
            alert(data);
            location.replace('index.php?tab=login');
          } else {
            location.replace('index.php')
          }
          
      })
    }
  </script>
<?php
  } else {
    header('Location: index.php');
  }
?>
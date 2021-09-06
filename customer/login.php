
<?php 
  if (!isset($_SESSION['CustomerID'])){
    // die("Chưa có")
?>
  <div class="main">
    <form action="" method="POST" class="form" id="login-form">
      <h3 class="heading">Login</h3>
      <div class="spacer"></div>
      <div class="form-group">
          <label for="cusid" class="form-label">Your's ID</label>
          <input id="cusid" name="cusid" rules="required" type="text" class="form-control">
          <span class="form-message"></span>
      </div>

      <div class="form-group">
          <label for="password" class="form-label">Password</label>
          <input id="password" name="password" rules="required|min:6" type="password"  class="form-control">
          <span class="form-message"></span>
      </div>

      <button class="form-submit btn btn-info text-white">Login</button>
      <a href="index.php?tab=register" class="new-user btn btn-info text-white">Register</a>
    </form>
  </div>
  <script src="./js/validator.js"></script>
  <script>

    var loginForm = new Validator('#login-form')
    loginForm.onSubmit = function (formData){
      $.post('./customer/checkLogin.php', {
        'cusid': formData['cusid'],
        'password': formData['password']
      }, function(data) {
          if(data){
            alert(data);
            location.reload();
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

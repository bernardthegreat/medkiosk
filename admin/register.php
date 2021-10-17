<?php
  require "../config/config.php";
  include "includes/login_header.php"; 
?>
<div class="login-box">
  <div class="login-logo">
    <b>Admin</b>MedKIOSK
  </div>
<div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="name" placeholder="Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</form>

<?php if (isset($_POST['username'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $password_hash =  sha1($password);
  $name = $_POST['name'];

  try {
    $user_check = "select * from users where username = '$username'";
    $result = $conn->query($user_check);

    if ($result->num_rows == 0) {
      $sql_register = "insert into users (username, password, name) values ('$username', '$password_hash', '$name')";
      $execute_query = $conn->query($sql_register);
      echo "Success";
    } else {
      echo "Already registered!";
    }
  } catch (Exception $e) {
    echo "Error occured: ".$e;
  }
}

?>

<?php include "includes/login_footer.php"; ?>

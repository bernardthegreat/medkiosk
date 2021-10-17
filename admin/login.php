<?php 
  include "includes/login_header.php";
  require "../config/config.php"; 
?>
<div class="login-box">
  <div class="login-logo">
    <b>Admin</b>MedKIOSK
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="POST">
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
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-0">
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<?php 
  session_start();
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_hash = sha1($password);
    $sql_check = "select * from users where username = '$username' and password = '$password_hash'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['name'] = $row['name'];
      if (isset($_SESSION['user_id'])) {
        header("Location: index.php");
      }
    } else {
      echo "User not found!";
    }
  }
?>
<?php include "includes/login_footer.php"; ?>
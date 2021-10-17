<?php
  require "../config/config.php";
  if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
  }
?>
<div class="row">
  <div class="col-lg-4 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>
          <?php
            $sql_query = "select * from medicines";
            $medicines = $conn->query($sql_query);
            echo $medicines->num_rows;
          ?>
        </h3>
        <p>Overall Medicines</p>
      </div>
      <div class="icon">
        <i class="fa fa-prescription"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-4 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>
          <?php
            $users_query = "select * from users";
            $users = $conn->query($users_query);
            echo $users->num_rows;
          ?>
        </h3>
        <p>Overall Users</p>
      </div>
      <div class="icon">
        <i class="fa fa-users"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-4 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>
          <?php
            $branches_query = "select * from branches";
            $branches = $conn->query($branches_query);
            echo $branches->num_rows;
          ?>
        </h3>
        <p>Overall Branches</p>
      </div>
      <div class="icon">
        <i class="fa fa-clinic-medical"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
</div>
<?php
  session_start(); 
  include "../includes/header.php"; 
  if (isset($_GET['id'])) {
    require "../../config/config.php";
    include "../includes/sidebar.php";
    $id = $_GET['id'];
    $sql = "select * from branches where id = '$id'";
    $result = $conn->query($sql);
    $result_query = $result->fetch_assoc();
  }
?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Medicine KIOSK Branches</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit <?php echo $result_query['name']; ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header text-center text-uppercase display-4 bg-primary">
                <?php echo $result_query['name']; ?>
              </div>
              <div class="card-body">
                <form action="" method="post">
                  <div class="input-group mb-3">
                    <input type="hidden" name="id" value="<?php echo $result_query['id']; ?>">
                    <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $result_query['name']; ?>">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="description" placeholder="Description" value="<?php echo $result_query['description']; ?>">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="status" name="branch_status" value="<?php echo ($result_query['status'] == 1) ? '1' : ''; ?>" <?php echo ($result_query['status'] == 1) ? 'checked' : ''; ?>>
                      <label class="form-check-label" for="status">Active</label>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <!-- /.col -->
                    <div class="col-4">
                      <button type="submit" name="update" class="btn btn-primary btn-block">UPDATE</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
  try {
    if (isset($_POST['update'])) {
      $id = $_POST['id'];
      $name = $_POST['name'];
      $description = $_POST['description'];
      if (isset($_POST['branch_status'])) {
        $status =  1;
      } else {
        $status = 0;
      }
      try {
        $sql_update = "update branches set name = '$name', description = '$description', status = $status, datetime_updated = CURRENT_TIMESTAMP where id  = '$id'";
        $execute_query = $conn->query($sql_update);
        if(isset($execute_query)) {
          $base_url = 'http://'.$_SERVER['SERVER_NAME'];
          echo "<script>window.location.replace('$base_url/admin/branches');</script>";
          // header("Location: index.php");
        }
      } catch (Exception $e) {
        echo "Error occured: ".$e;
      }
    }
  } catch (Exception $e) {
    echo $e;
  }
  include "../includes/footer.php";
?>

<script>
  $('#status').on('click', function () {
    $(this).val(this.checked ? 1 : 0);
  });
</script>
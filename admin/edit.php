<?php
  session_start(); 
  require "../config/config.php";
  include "includes/header.php"; 
  include "includes/sidebar.php";

  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
      $sql = "select * from medicines where id = '$id'";
      $result = $conn->query($sql);
      $result_query = $result->fetch_assoc();
      if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $branch = $_POST['branch'];
        if (isset($_POST['med_status'])) {
          $status =  1;
        } else {
          $status = 0;
        }

        try {
          $sql_update = "update medicines set name = '$name', branch = '$branch', status = $status, datetime_updated = CURRENT_TIMESTAMP where id  = '$id'";
          $execute_query = $conn->query($sql_update);
          if(isset($execute_query)) {
            $message = "Successfully updated ".$name."!";
            header("Location:index.php?message=".$message);
          }
        } catch (Exception $e) {
          echo "Error occured: ".$e;
        }
      }
    } catch (Exception $e) {
      echo $e;
    }
  }
?>
<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Medicine KIOSK Admin</h1>
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
                    <input type="text" class="form-control" name="name" placeholder="Medicine Name" value="<?php echo $result_query['name']; ?>">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="branch" placeholder="Branch" value="<?php echo $result_query['branch']; ?>">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="status" name="med_status" value="<?php echo ($result_query['status'] == 1) ? '1' : ''; ?>" <?php echo ($result_query['status'] == 1) ? 'checked' : ''; ?>>
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
  include "includes/footer.php";
?>

<script>
  $('#status').on('click', function () {
    $(this).val(this.checked ? 1 : 0);
  });
</script>
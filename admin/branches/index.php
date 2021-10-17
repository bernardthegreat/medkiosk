<?php
  session_start(); 
  include "../includes/header.php";
  require "../../config/config.php";
  if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
  }
  include "../includes/sidebar.php";
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">MedKIOSK Branches</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Branches</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">BRANCHES</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                        <i class="fas fa-plus"></i><span class="pl-2">REGISTER NEW BRANCH</span>
                      </button>
                      <form action="" method="post">
                        <div class="modal fade" id="modal-default">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">NEW BRANCHES</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" name="name" placeholder="Name" required>
                                  <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-user"></span>
                                    </div>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" name="description" placeholder="Description" required>
                                  <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-user"></span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                              </div>
                              <?php 
                                if (isset($_POST['name'])) {
                                  $name = $_POST['name'];
                                  $description = $_POST['description'];

                                  try {
                                    $user_check = "select * from users where name = '$name'";
                                    $result = $conn->query($user_check);

                                    if ($result->num_rows == 0) {
                                      echo $sql_register = "insert into branches (name, description) values ('$name', '$description')";
                                      $execute_query = $conn->query($sql_register);
                                      $message = "Successfully registered!";
                                    } else {
                                      $message = "Error registering, already exist!";
                                    }
                                  } catch (Exception $e) {
                                    $message = "Error registering!". $e->get_message();
                                  }
                                }
                              ?>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="card-body">
                    <?php 
                      $user_id = $_SESSION['user_id'];
                      $users_query = "select * from branches";
                      $users = $conn->query($users_query);
                      if ($users->num_rows > 0) {
                    ?>
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Date Created</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php 
                            while ($row = $users->fetch_assoc()) {
                          ?>
                            <tr>
                              <td><?php echo $row['name']; ?></td>
                              <td><?php echo $row['description']; ?></td>
                              <td><?php echo date("F d, Y", strtotime($row['datetime_created'])); ?></td>
                              <td><?php echo ($row['status'] == 1) ? 'Active' : 'Inactive'; ?></td>
                              <td>
                                <div class="btn-group">
                                  <a href="edit.php?id=<?php echo $row['id'];?>" type="button" class="btn btn-success">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <a href="delete.php?id=<?php echo $row['id'];?>" type="button" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this branch?');" >
                                    <i class="fas fa-trash"></i>
                                  </a>
                                </div>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Date Created</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                        </tfoot>
                      </table>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<?php 
  include "../includes/footer.php";
?>

<style>
  .select2-selection__rendered li {
    color: black !important;
  }
</style>
<script>
  $(function () {
    $('.select2').select2()
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
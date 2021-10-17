<?php
  session_start(); 
  include "includes/header.php";
  require "../config/config.php";
  if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
  }

  include "includes/sidebar.php";
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">MedKIOSK Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <?php include "includes/tracking.php"; ?>
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">MEDICINES</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                        <i class="fas fa-plus"></i><span class="pl-2">REGISTER MEDICINE</span>
                      </button>
                      <form action="" method="post">
                        <div class="modal fade" id="modal-default">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">NEW MEDICINE</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" name="name" placeholder="Name" required>
                                  <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-envelope"></span>
                                    </div>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                  <?php 
                                    $sql_query = "select * from branches";
                                    $branches = $conn->query($sql_query);
                                  ?>
                                  <select class="select2" multiple="multiple" data-placeholder="Branches" style="width: 100%;" name="branches[]">
                                    <?php 
                                      $index = 0;
                                      while ($row = $branches->fetch_assoc()) {
                                        if ($row['status'] === '1') {
                                    ?>
                                          <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                                    <?php 
                                        }
                                      }
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Register</button>
                              </div>

                              <?php if (isset($_POST['name'])) {
                                $values = $_POST['branches'];
                                $branches = '';
                                foreach ($values as $key => $branch){
                                  if ($key === array_key_last($values)) {
                                    $branches .= $branch;
                                  } else {
                                    $branches .= $branch.', ';
                                  }
                                }
                                $name = $_POST['name'];

                                try {
                                  $medicine_check = "select * from medicines where name = '$name'";
                                  $result = $conn->query($medicine_check);

                                  if ($result->num_rows == 0) {
                                    $sql_register = "insert into medicines (name, branch) values ('$name', '$branches')";
                                    $execute_query = $conn->query($sql_register);
                                    $message = "Successfully registered!";
                                    echo "<script>location.reload();</script>";
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
                      $sql_query = "select * from medicines";
                      $medicines = $conn->query($sql_query);
                      if ($medicines->num_rows > 0) {
                    ?>
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Medicine Name</th>
                          <th>Branches</th>
                          <th>Date Created</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php 
                            while ($row = $medicines->fetch_assoc()) {
                          ?>
                            <tr>
                              <td><?php echo $row['name']; ?></td>
                              <td><?php echo $row['branch']; ?></td>
                              <td><?php echo date("F d, Y", strtotime($row['datetime_created'])); ?></td>
                              <td><?php echo ($row['status'] == 1) ? 'Active' : 'Inactive'; ?></td>
                              <td>
                                <div class="btn-group">
                                  <a href="edit.php?id=<?php echo $row['id'];?>" type="button" class="btn btn-success">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <a href="delete.php?id=<?php echo $row['id'];?>" type="button" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this medicine?');" >
                                    <i class="fas fa-trash"></i>
                                  </a>
                                </div>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>Medicine Name</th>
                          <th>Branches</th>
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
  include "includes/footer.php";
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
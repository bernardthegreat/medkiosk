<?php include "includes/header.php"; ?>
<?php require "config/config.php"; ?>
<div class="masthead">
    <div class="masthead-content text-white">
        <div class="container-fluid px-4 px-lg-0">
            <h1 class="fst-italic lh-1 mb-4">Pharmacy KIOSK</h1>

            <form id="contactForm" method="GET" actions="">
              <div class="row input-group-newsletter">
                  <div class="col">
                    <input class="form-control" id="name" autocomplete="off" autofocus name="medicine" type="text" placeholder="Enter medicine..." aria-label="Enter medicine..." data-sb-validations="required" />
                  </div>
                  <div class="col-auto">
                    <button class="btn btn-primary" id="submitButton" type="submit" name="submitQuery">Submit</button>
                  </div>
              </div>
            </form>

            <?php 
              if (isset($_GET['submitQuery'])) {
                $search_term = $_GET['medicine'];

                $sql_query = "select * from medicines where name like '%$search_term%'";
                $result = $conn->query($sql_query);
                if ($result->num_rows > 0) {
            ?>
              <div class="mt-5">
                <table class="table text-white text-center">
                  <thead>
                    <tr>
                      <th scope="col">Name</th>
                      <th scope="col">Branch</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      while ($row = $result->fetch_assoc()) {
                    ?>
                      
                      <tr>
                        <td scope="row"> <?php echo $row['name']; ?> </td>
                        <td> <?php echo $row['branch']; ?> </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

            <?php
                } else {
                  echo "
                    <div class='mt-5 alert alert-danger' role='alert'>
                      Medicine not found!
                    </div>";
                }
              }
            ?>
        </div>
    </div>
</div>



<?php include "includes/footer.php"; ?>
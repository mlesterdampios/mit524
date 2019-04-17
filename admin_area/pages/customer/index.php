<?php require_once('../../functions/functions.php'); 

session_start();

$admin = array();
if(isset( $_SESSION['admin']) && !empty($_SESSION['admin'])) {
    $admin = $_SESSION['admin'];
}else{
    header("Location: ".BASE_URL);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../../includes/pages/header.php'); ?>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include_once('../../includes/pages/menu.php'); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include_once('../../includes/pages/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Customers List</p>
                  <div class="table-responsive">
                    <table id="customer-listing" class="display" style="width:100%">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Address</th>
                              <th>Country</th>
                              <th>Phone Number</th>
                              <th>Date Created</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php getCustomers(); ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include_once('../../includes/pages/footer.php'); ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <?php include_once('../../includes/pages/scripts.php'); ?>
  <!-- End custom js for this page-->
</body>

</html>


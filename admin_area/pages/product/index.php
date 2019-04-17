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
                  <p class="card-title">Products List&nbsp;<a type="button" href="<?php echo BASE_URL;?>pages/product/add" class="btn btn-primary">Add Product</a></p>
                  <div class="table-responsive">
                    <table id="recent-purchases-listing" class="display" style="width:100%">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Category</th>
                              <th>Brand</th>
                              <th>Product Name</th>
                              <th>Product Price</th>
                              <th>Is Available</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php getProducts(); ?>
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


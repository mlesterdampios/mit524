<?php require_once('../../functions/functions.php'); 

session_start();

$admin = array();
if(isset( $_SESSION['admin']) && !empty($_SESSION['admin'])) {
    $admin = $_SESSION['admin'];
}else{
    header("Location: ".BASE_URL);
}


if ( filter_has_var( INPUT_POST, 'submit' ) && isset($_GET['id']) && !empty($_GET['id'])) {
  $post['customer_isdeleted'] = $_POST['customer_isdeleted'];
  $id = setCustomer($post, $_GET['id']);
  if($id == false){
    header("Location: ".BASE_URL."pages/customer/index");
  }else{
    header("Location: ".BASE_URL."pages/customer/edit?id=".$id);
  }
}else if(!isset($_GET['id']) || empty($_GET['id'])){
  header("Location: ".BASE_URL."pages/customer/index");
}

$customer = getCustomerByID($_GET['id']);
if($customer==null){
  header("Location: ".BASE_URL."pages/customer/index");
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
                  <h4 class="card-title">Edit Customer</h4>
                  <form class="form-sample" method="post">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="customer_isdeleted">
                              <option <?php echo ($customer['customer_isdeleted']==1) ? 'selected' : null; ?> value="1">No</option>
                              <option <?php echo ($customer['customer_isdeleted']==0) ? 'selected' : null; ?> value="0">Yes</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Full Name:</label>
                          <div class="col-sm-9">
                            <label class="col-form-label"><?php echo $customer['customer_billing_firstname']." ".$customer['customer_billing_lastname']; ?></label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Company Name:</label>
                          <div class="col-sm-9">
                            <label class="col-form-label"><?php echo $customer['customer_billing_companyname']; ?></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Country:</label>
                          <div class="col-sm-9">
                            <label class="col-form-label"><?php echo $customer['customer_billing_country']; ?></label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address:</label>
                          <div class="col-sm-9">
                            <label class="col-form-label"><?php echo $customer['customer_billing_address1']; ?></label>
                          </div>
                        </div>
                      </div>
                    </div>                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Town / City:</label>
                          <div class="col-sm-9">
                            <label class="col-form-label"><?php echo $customer['customer_billing_towncity']; ?></label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Zip:</label>
                          <div class="col-sm-9">
                            <label class="col-form-label"><?php echo $customer['customer_billing_zip']; ?></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
                  </form>
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
  <script src="../../js/pell.js"></script>
  <!-- End custom js for this page-->
</body>

</html>


<?php require_once('../../functions/functions.php'); 

session_start();

$admin = array();
if(isset( $_SESSION['admin']) && !empty($_SESSION['admin'])) {
    $admin = $_SESSION['admin'];
}else{
    header("Location: ".BASE_URL);
}


if ( filter_has_var( INPUT_POST, 'submit' ) && isset($_GET['id']) && !empty($_GET['id'])) {
  $post['payment_status'] = $_POST['payment_status'];
  $id = setOrder($post, $_GET['id']);
  if($id == false){
    header("Location: ".BASE_URL."pages/order/index");
  }else{
    header("Location: ".BASE_URL."pages/order/edit?id=".$id);
  }
}else if(!isset($_GET['id']) || empty($_GET['id'])){
  header("Location: ".BASE_URL."pages/order/index");
}

$order = getOrderByID($_GET['id']);
if($order==null){
  header("Location: ".BASE_URL."pages/order/index");
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
                  <h4 class="card-title">Edit Order</h4>
                  <form class="form-sample" method="post">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Status</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="payment_status">
                              <?php $paymentStatuses = ['Pending', 'Confirmed', 'Shipping', 'For Delivery', 'Completed', 'Returned'];
                              foreach($paymentStatuses as $p){
                                $isSelected = ($p==$order['payment_status']) ? 'selected' : null;
                              ?>
                                <option <?php echo $isSelected; ?> value="<?php echo $p;?>"><?php echo $p;?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Payment Mode:</label>
                          <div class="col-sm-9">
                            <label class="col-form-label"><?php echo $order['payment_mode_name']; ?></label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Total Price:</label>
                          <div class="col-sm-9">
                            <label class="col-form-label"><?php echo $order['payment_total_price']; ?></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Full Name:</label>
                          <div class="col-sm-9">
                            <label class="col-form-label"><?php echo $order['payment_billing_firstname']." ".$order['payment_billing_lastname']; ?></label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Company Name:</label>
                          <div class="col-sm-9">
                            <label class="col-form-label"><?php echo $order['payment_billing_companyname']; ?></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Country:</label>
                          <div class="col-sm-9">
                            <label class="col-form-label"><?php echo $order['payment_billing_country']; ?></label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address:</label>
                          <div class="col-sm-9">
                            <label class="col-form-label"><?php echo $order['payment_billing_address1']; ?></label>
                          </div>
                        </div>
                      </div>
                    </div>                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Town / City:</label>
                          <div class="col-sm-9">
                            <label class="col-form-label"><?php echo $order['payment_billing_towncity']; ?></label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Zip:</label>
                          <div class="col-sm-9">
                            <label class="col-form-label"><?php echo $order['payment_billing_zip']; ?></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
                  </form>
                  <hr>
                  <div class="table-responsive">
                    <table id="recent-purchases-listing" class="display" style="width:100%">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Product</th>
                              <th>Price</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php getOrderItems($order['id']); ?>
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
  <script src="../../js/pell.js"></script>
  <!-- End custom js for this page-->
</body>

</html>


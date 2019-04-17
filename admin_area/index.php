<?php require_once('functions/functions.php'); 

session_start();

function login($post){
  $con = getConnection();
  $stringQuery_getAdmins="select * from tbl_admins where admin_username like '".mysqli_real_escape_string($con, $post['admin_username'])."' and admin_password like '".md5(mysqli_real_escape_string($con, $post['admin_password']))."'";
  $query_getAdmins=mysqli_query($con, $stringQuery_getAdmins);
  $admin = array();
  While ($row_Admins=mysqli_fetch_array($query_getAdmins)){
      $admin = $row_Admins;
      $_SESSION['admin'] = $row_Admins;
  }
  if (!empty($admin)){
      return true;
  }
  return false;
}

$message = array();

if ( filter_has_var( INPUT_POST, 'submit' ) ) {
  $post['admin_username'] = $_POST['admin_username'];
  $post['admin_password'] = $_POST['admin_password'];
  $id = login($post);
  if($id == false){
    $message= array("error" => true, "message" => "Username or password incorrect.");
  }else{
    header("Location: ".BASE_URL."pages/order/");
  }
}

if(isset( $_SESSION['admin']) && !empty($_SESSION['admin'])) {
  header("Location: ".BASE_URL."pages/order/");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>EasyShop Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="images/logo.png" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.<br>
              <?php echo (isset($message['error'])) ? $message['message'] : null; ?>
              </h6>
              <form class="pt-3" method="post">
                <div class="form-group">
                  <input type="text" name="admin_username" class="form-control form-control-lg" id="admin_username" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="admin_password" class="form-control form-control-lg" id="admin_password" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
</body>

</html>

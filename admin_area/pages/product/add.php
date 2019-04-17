<?php require_once('../../functions/functions.php'); 

session_start();

$admin = array();
if(isset( $_SESSION['admin']) && !empty($_SESSION['admin'])) {
    $admin = $_SESSION['admin'];
}else{
    header("Location: ".BASE_URL);
}


if ( filter_has_var( INPUT_POST, 'submit' ) ) {
  $post['product_name'] = $_POST['product_name'];
  $post['product_shortdescription'] = $_POST['product_shortdescription'];
  $post['brand_id'] = $_POST['brand_id'];
  $post['category_id'] = $_POST['category_id'];
  $post['product_price'] = $_POST['product_price'];
  $post['product_isavailable'] = $_POST['product_isavailable'];
  $post['product_wysiwyg_description'] = $_POST['product_wysiwyg_description'];
  $id = setProduct($post);
  if($id == false){
    header("Location: ".BASE_URL."pages/product/index");
  }else{
    header("Location: ".BASE_URL."pages/product/edit?id=".$id);
  }
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
                  <h4 class="card-title">Add Product</h4>
                  <form class="form-sample" method="post">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Category</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="category_id">
                              <?php getCategories(); ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Brand</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="brand_id">
                              <?php getBrands(); ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Product Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="product_name" value="">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Price</label>
                          <div class="col-sm-9">
                            <input type="number" min="0" class="form-control" name="product_price" value="0">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Short Description</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" name="product_shortdescription" rows="4"></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Is Available</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="product_isavailable">
                              <option value="1" >Yes</option>
                              <option value="0" >No</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-md-12 col-form-label">Full Description</label>
                      <div class="col-md-12">
                        <div id="editor" class="pell"></div>
                        <input id="text-output" hidden name="product_wysiwyg_description" value=''>
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
    <script>
      var editor = window.pell.init({
        element: document.getElementById('editor'),
        defaultParagraphSeparator: 'p',
        onChange: function (html) {
          document.getElementById('text-output').value = html
        }
      });
    </script>
  <!-- End custom js for this page-->
</body>

</html>


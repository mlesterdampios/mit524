<?php require_once('../../functions/functions.php'); 

session_start();

$admin = array();
if(isset( $_SESSION['admin']) && !empty($_SESSION['admin'])) {
    $admin = $_SESSION['admin'];
}else{
    header("Location: ".BASE_URL);
}


if ( filter_has_var( INPUT_POST, 'submit' ) && isset($_GET['id']) && !empty($_GET['id'])) {
  $post['product_name'] = $_POST['product_name'];
  $post['product_shortdescription'] = $_POST['product_shortdescription'];
  $post['brand_id'] = $_POST['brand_id'];
  $post['category_id'] = $_POST['category_id'];
  $post['product_price'] = $_POST['product_price'];
  $post['product_isavailable'] = $_POST['product_isavailable'];
  $post['product_wysiwyg_description'] = $_POST['product_wysiwyg_description'];
  $id = setProduct($post, $_GET['id']);
  if($id == false){
    header("Location: ".BASE_URL."pages/product/index");
  }else{
    header("Location: ".BASE_URL."pages/product/edit?id=".$id);
  }
}else if(!isset($_GET['id']) || empty($_GET['id'])){
  header("Location: ".BASE_URL."pages/product/index");
}

if ( filter_has_var( INPUT_POST, 'upload' ) && isset($_GET['id']) && !empty($_GET['id']) && $_FILES['fileToUpload']['name']!='') {
  $target_dir = "../../../uploads/products/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          //echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          //echo "File is not an image.";
          $uploadOk = 0;
      }
  }
  // Check if file already exists
  if (file_exists($target_file)) {
      unlink($target_file);
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
      //echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
     // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
      setProductImage(basename( $_FILES["fileToUpload"]["name"]), $_GET['id']);
  } else {

  }
  
}

$product = getProductByID($_GET['id']);
if($product==null){
  header("Location: ".BASE_URL."pages/product/index");
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
                  <h4 class="card-title">Edit Product</h4>
                  <form class="form-sample"  method="post" enctype="multipart/form-data">
                    <div class="row" style="padding-bottom:20px">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Image Upload</label>
                          <div class="input-group col-sm-9">
                            <input type="file" class="form-control file-upload-info" name="fileToUpload" placeholder="Select Image">
                            <span class="input-group-append">
                              <button type="submit" name="upload" class="form-control btn btn-primary mr-2">Upload</button>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="col-sm-12">
                          <?php if ($product['product_image']!=null){ ?>
                            <img src="<?php echo BASE_URL.'../uploads/products/'.$product['product_image']; ?>" alt="Product Image" style="max-width: 100%; max-height: auto;">
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </form>
                  <form class="form-sample" method="post">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Category</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="category_id">
                              <?php getCategories($product['category_id']); ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Brand</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="brand_id">
                              <?php getBrands($product['brand_id']); ?>
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
                            <input type="text" class="form-control" name="product_name" value="<?php echo $product['product_name']; ?>">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Price</label>
                          <div class="col-sm-9">
                            <input type="number" min="0" class="form-control" name="product_price" value="<?php echo $product['product_price']; ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Short Description</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" name="product_shortdescription" rows="4"><?php echo $product['product_shortdescription']; ?></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Is Available</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="product_isavailable">
                              <option value="1" <?php echo ($product['product_isavailable']==1) ? 'selected' : null; ?>>Yes</option>
                              <option value="0" <?php echo ($product['product_isavailable']==0) ? 'selected' : null; ?>>No</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-md-12 col-form-label">Full Description</label>
                      <div class="col-md-12">
                        <div id="editor" class="pell"></div>
                        <input id="text-output" hidden name="product_wysiwyg_description" value='<?php echo $product["product_wysiwyg_description"]; ?>'>
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
      editor.content.innerHTML = '<?php echo $product["product_wysiwyg_description"]; ?>';
    </script>
  <!-- End custom js for this page-->
</body>

</html>


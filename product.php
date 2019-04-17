<?php require_once('functions/functions.php'); 

$product = getProduct();

session_start();

if ( filter_has_var( INPUT_POST, 'submit' ) ) {
    if( isset( $_SESSION['cart_items'] ) ) {
        array_push($_SESSION['cart_items'], $product);
     }else {
		$_SESSION['cart_items'] = array();
        array_push($_SESSION['cart_items'], $product);
     }
     
    header("Location: ".BASE_URL."cart");
  }
  $productImage = ($product['product_image']!=null && !empty($product['product_image'])) ? "<img class='img-fluid' src='".BASE_URL.'uploads/products/'.$product['product_image']."' alt='Product Image'>" :
  "<img class='img-fluid' src='".BASE_URL.'uploads/products/default.jpg'."' alt='Product Image'>";
?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>EasyShop</title>

	<!--
            CSS
            ============================================= -->
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
</head>

<body id="category">

    <?php include_once('includes/menu.php'); ?>

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Product Details Page</h1>
					<nav class="d-flex align-items-center">
						<a href="<?php echo BASE_URL; ?>">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="<?php echo BASE_URL; ?>shop">Shop<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Product Details</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="s_Product_carousel">
						<div class="single-prd-item">
							<?php echo $productImage; ?>
						</div>
						<div class="single-prd-item">
                            <?php echo $productImage; ?>
						</div>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3><?php echo $product['product_name']; ?></h3>
						<h2>&#8369;<?php echo $product['product_price']; ?></h2>
						<ul class="list">
							<li><a class="active" href="<?php echo BASE_URL; ?>"><span>Category</span> : <?php echo $product['category_name']; ?></a></li>
							<li><a href="<?php echo BASE_URL; ?>"><span>Is Available</span> : <?php echo ($product['product_isavailable']) ? 'Yes' : 'No'; ?></a></li>
						</ul>
						<p><?php echo $product['product_shortdescription']; ?></p>
						<div class="card_area d-flex align-items-center">
                            <form method="post">
                                <button type="submit" name="submit" class="primary-btn">Add To Cart</button>
                            </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
					<p><?php echo $product['product_wysiwyg_description']; ?></p>
				</div>
			</div>
		</div>
	</section>
	<!--================End Product Description Area =================-->

	<!-- End related-product Area -->
	<?php include_once('includes/footer.php'); ?>
	
</body>

</html>
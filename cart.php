<?php require_once('functions/functions.php');

session_start();

$cart_products = array();

if(! isset( $_SESSION['cart_items'] ) ) {
    $_SESSION['cart_items'] = array();
}else{
    $cart_products = $_SESSION['cart_items'];
    //var_dump($cart_products);
}

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
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="<?php echo BASE_URL; ?>">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">Cart</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="min-width: 100px;">ID</th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $cart_total=0; foreach($cart_products as $item){ 
                                  $productImage = ($item['product_image']!=null && !empty($item['product_image'])) ? "<img style='width: 300px; height: 300px;' src='".BASE_URL.'uploads/products/'.$item['product_image']."' alt='Product Image'>" :
                                  "<img src='".BASE_URL.'uploads/products/default.jpg'."' style='width: 300px; height: 300px;' alt='Product Image'>";
                            ?>
                                
                            <tr>
                                <td>
                                    <h5><?php echo $item['id']; ?></h5>
                                </td>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <?php echo $productImage; ?>
                                        </div>
                                        <div class="media-body">
                                            <p><?php echo $item['product_name']; ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>&#8369;<?php echo $item['product_price']; ?></h5>
                                </td>
                            </tr>
                            <?php $cart_total += $item['product_price']; } ?>
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5>&#8369;<?php echo $cart_total; ?></h5>
                                </td>
                            </tr>
                            <tr class="out_button_area">
                                <td>
                                </td>
                                <td>

                                </td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="gray_btn" href="<?php echo BASE_URL; ?>shop">Continue Shopping</a>
                                        <a class="primary-btn" href="<?php echo BASE_URL; ?>checkout">Proceed to checkout</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
	<?php include_once('includes/footer.php'); ?>
	
</body>

</html>
<?php require_once('functions/functions.php');

session_start();

$user = array();
if(isset( $_SESSION['user']) && !empty($_SESSION['user'])) {
    $user = $_SESSION['user'];
}else{
    header("Location: ".BASE_URL."shop");
}
$payments = getPayments($user['id']);

$showID = false;

if(isset($_GET['show_id']) && !empty($_GET['show_id'])){
    $showID = getOrderDetails($_GET['show_id'], $user);
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
                    <h1>My Orders</h1>
                    <nav class="d-flex align-items-center">
                        <a href="<?php echo BASE_URL; ?>">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">My Orders</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
    <?php if ($showID!=null && $showID!=false){ ?>
	<!--================Order Details Area =================-->
	<section class="order_details section_gap">
		<div class="container">
			<h3 class="title_confirmation">Thank you. Your order has been received.</h3>
			<div class="row order_d_inner">
				<div class="col-lg-6">
					<div class="details_item">
						<h4>Order Info</h4>
						<ul class="list">
							<li><a href="#"><span>Order number</span> : <?php echo $showID['id']; ?></a></li>
							<li><a href="#"><span>Date</span> : <?php echo $showID['payment_date']; ?></a></li>
							<li><a href="#"><span>Total</span> : &#8369;<?php echo $showID['payment_total_price']; ?></a></li>
							<li><a href="#"><span>Payment method</span> : <?php echo $showID['payment_mode_name']; ?></a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="details_item">
						<h4>Shipping and Billing Address</h4>
						<ul class="list">
							<li><a href="#"><span>Street</span> : <?php echo $showID['payment_billing_address1']; ?></a></li>
							<li><a href="#"><span>City</span> : <?php echo $showID['payment_billing_towncity']; ?></a></li>
							<li><a href="#"><span>Country</span> : <?php echo $showID['payment_billing_country']; ?></a></li>
							<li><a href="#"><span>Postcode </span> : <?php echo $showID['payment_billing_zip']; ?></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="order_details_table">
				<h2>Order Details</h2>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Product</th>
								<th scope="col">Total</th>
							</tr>
						</thead>
						<tbody>
                            <?php $showIDTotal=0; foreach(getOrders($showID['id']) as $item){ ?>
							<tr>
								<td>
									<p><?php echo $item['product_name']; ?></p>
								</td>
								<td>
									<p>&#8369;<?php echo $item['order_product_price']; ?></p>
								</td>
                            </tr>
                            <?php $showIDTotal += $item['order_product_price']; } ?>
							<tr>
								<td>
									<h4>Total</h4>
								</td>
								<td>
									<p>&#8369;<?php echo $showIDTotal; ?></p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
    <!--================End Order Details Area =================-->
    <?php } ?>
    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Order Details</th>
                                <th scope="col">Items</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($payments as $p){ 
                            ?>
                                
                            <tr>
                                <td>
                                    <h5>Order ID : <?php echo $p['id'];?><br>
                                    Date of Order : <?php echo $p['payment_date'];?><br>
                                    Status : <?php echo $p['payment_status'];?><br>
                                    Payment Mode : <?php echo $p['payment_mode_name'];?><br>
                                    First Name : <?php echo $p['payment_billing_firstname'];?><br>
                                    Last Name : <?php echo $p['payment_billing_lastname'];?><br>
                                    Company Name : <?php echo $p['payment_billing_companyname'];?><br>
                                    Phone Number : <?php echo $p['payment_billing_phonenumber'];?><br>
                                    Country : <?php echo $p['payment_billing_country'];?><br>
                                    Address 1 : <?php echo $p['payment_billing_address1'];?><br>
                                    Address 2 : <?php echo $p['payment_billing_address2'];?><br>
                                    Town/City : <?php echo $p['payment_billing_towncity'];?><br>
                                    Zip : <?php echo $p['payment_billing_zip'];?><br>
                                    </h5>
                                </td>
                                <td>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="min-width: 100px;">ID</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $cart_total=0; foreach(getOrders($p['id']) as $item){ 
                                                $productImage = ($item['product_image']!=null && !empty($item['product_image'])) ? "<img style='width: 50px; height: 50px;' src='".BASE_URL.'uploads/products/'.$item['product_image']."' alt='Product Image'>" :
                                                "<img src='".BASE_URL.'uploads/products/default.jpg'."' style='width: 50px; height:50px;' alt='Product Image'>";
                                            ?>
                                                
                                            <tr>
                                                <td>
                                                    <h5><?php echo $item['product_id']; ?></h5>
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
                                                    <h5>&#8369;<?php echo $item['order_product_price']; ?></h5>
                                                </td>
                                            </tr>
                                            <?php $cart_total += $item['order_product_price']; } ?>
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                    <h5>Total</h5>
                                                </td>
                                                <td>
                                                    <h5>&#8369;<?php echo $cart_total; ?></h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                
                            </tr>
                            <?php } ?>
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
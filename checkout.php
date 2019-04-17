<?php require_once('functions/functions.php'); 

$customer_username = "";
$customer_password = "";
$customer_billing_firstname = "";
$customer_billing_lastname = "";
$customer_billing_companyname = "";
$customer_billing_phonenumber = "";
$customer_billing_country = "";
$customer_billing_address1 = "";
$customer_billing_address2 = "";
$customer_billing_towncity = "";
$customer_billing_zip = "";
$payment_mode_name = "Cash On Delivery";

session_start();

$cart_products = array();

if(! isset( $_SESSION['cart_items'] ) || empty($_SESSION['cart_items'])) {
    header("Location: ".BASE_URL."shop");
}else{
    $cart_products = $_SESSION['cart_items'];
}

$user = array();

if( isset( $_SESSION['user'] ) ) {
    $user = $_SESSION['user'];
    $customer_billing_firstname = $user['customer_billing_firstname'];
    $customer_billing_lastname = $user['customer_billing_lastname'];
    $customer_billing_companyname = $user['customer_billing_companyname'];
    $customer_billing_phonenumber = $user['customer_billing_phonenumber'];
    $customer_billing_country = $user['customer_billing_country'];
    $customer_billing_address1 = $user['customer_billing_address1'];
    $customer_billing_address2 = $user['customer_billing_address2'];
    $customer_billing_towncity = $user['customer_billing_towncity'];
    $customer_billing_zip = $user['customer_billing_zip'];
}

$message = array("error" => false);
if ( filter_has_var( INPUT_POST, 'submit' ) ) {
    $order = array();
    $order['payment_mode_name'] = $_POST['payment_mode_name'];
    $order['customer_username'] = isset($_POST['customer_username']) ? $_POST['customer_username'] : null;
    $order['customer_password'] = isset($_POST['customer_password']) ? $_POST['customer_password'] : null;
    $order['customer_billing_firstname'] = $_POST['customer_billing_firstname'];
    $order['customer_billing_lastname'] = $_POST['customer_billing_lastname'];
    $order['customer_billing_companyname'] = $_POST['customer_billing_companyname'];
    $order['customer_billing_phonenumber'] = $_POST['customer_billing_phonenumber'];
    $order['customer_billing_country'] = $_POST['customer_billing_country'];
    $order['customer_billing_address1'] = $_POST['customer_billing_address1'];
    $order['customer_billing_address2'] = $_POST['customer_billing_address2'];
    $order['customer_billing_towncity'] = $_POST['customer_billing_towncity'];
    $order['customer_billing_zip'] = $_POST['customer_billing_zip'];
    $message = placeOrder($order, $cart_products, $user);
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
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/ion.rangeSlider.css" />
	<link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/main.css">
</head>

<body>
	<?php include_once('includes/menu.php'); ?>
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Checkout</h1>
                    <nav class="d-flex align-items-center">
                        <a href="<?php echo BASE_URL; ?>">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="">Checkout</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
        <div class="container">
            <form action="#" method="post">
                <div class="check_title">
                    <h2><?php echo ($message['error']) ? ($message['message']) : null; ?></h2>
                </div>
                <?php if(empty($_SESSION['user']) || !isset($_SESSION['user'])){ ?>
                <div class="returning_customer">
                    <div class="check_title">
                        <h2>Returning Customer? <a href="<?php echo BASE_URL.'login';?>">Click here to login</a></h2>
                    </div>
                    <p>If you are a new customer, please fill out this section to create your account <br>
                    Or if you are a returning customer, click the link above to login.</p>
                    <div class="row contact_form">
                        <div class="col-md-6 form-group p_star">
                            <input placeholder="Username or Email" type="text" class="form-control" id="name" name="customer_username" value="<?php echo $customer_username; ?>">
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input placeholder="Password" type="password" class="form-control" id="password" name="customer_password" value="<?php echo $customer_password; ?>">
                        </div>
                    </div>
                </div>
                <?php }else{ ?>
                    <div class="check_title">
                        <h2>Logged in as: <?php echo $_SESSION['user']['customer_username']; ?> <br>
                        Not you? <a href="<?php echo BASE_URL.'logout'; ?>">Click here</a></h2>
                    </div>
                <?php } ?>
                <div class="billing_details">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3>Billing and Shipping Details</h3>
                            <div class="row contact_form">
                                <div class="col-md-6 form-group p_star">
                                    <input placeholder="First name" type="text" class="form-control" id="first" name="customer_billing_firstname" value="<?php echo $customer_billing_firstname; ?>">
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input placeholder="Last name" type="text" class="form-control" id="last" name="customer_billing_lastname" value="<?php echo $customer_billing_lastname; ?>">
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" id="company" name="customer_billing_companyname" placeholder="Company name" value="<?php echo $customer_billing_companyname; ?>">
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input placeholder="Phone number" type="text" class="form-control" id="number" name="customer_billing_phonenumber" value="<?php echo $customer_billing_phonenumber; ?>">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <select class="country_select" name="customer_billing_country">
                                        <?php $countries = ['Philippines']; for($i=0; $i < count($countries); $i++){ ?>
                                        <option <?php echo ($countries[$i]==$customer_billing_country) ? 'selected' : null; ?> value="<?php echo $countries[$i]; ?>"><?php echo $countries[$i]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input placeholder="Address line 01" type="text" class="form-control" id="add1" name="customer_billing_address1" value="<?php echo $customer_billing_address1; ?>">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input placeholder="Address line 02" type="text" class="form-control" id="add2" name="customer_billing_address2" value="<?php echo $customer_billing_address2; ?>">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input placeholder="Town/City" type="text" class="form-control" id="city" name="customer_billing_towncity" value="<?php echo $customer_billing_towncity; ?>">
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" id="zip" name="customer_billing_zip" placeholder="Postcode/ZIP" value="<?php echo $customer_billing_zip; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order_box">
                                <h2>Your Order</h2>
                                <ul class="list">
                                    <li><a href="#">Product <span>Total</span></a></li>
                                    <?php $totalPrice=0; foreach($cart_products as $c){ ?>
                                    <li><a href="#"><?php echo $c['product_name']; ?><span class="middle"></span> <span class="last">&#8369;<?php echo $c['product_price']; ?></span></a></li>
                                    <?php $totalPrice += $c['product_price']; } ?>

                                </ul>
                                <ul class="list list_2">
                                    <li><a href="#">Total <span>&#8369;<?php echo $totalPrice; ?></span></a></li>
                                </ul>
                                <div class="payment_item">
                                    <div class="radion_btn">
                                        <input type="radio" <?php echo ($payment_mode_name=='Cash On Delivery') ? 'checked' : null; ?> value="Cash On Delivery" id="payment_mode_name" name="payment_mode_name">
                                        <label for="payment_mode_name">Cash On Delivery</label>
                                        <div class="check"></div>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="primary-btn">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!--================End Checkout Area =================-->

	<?php include_once('includes/footer.php'); ?>
	
</body>

</html>
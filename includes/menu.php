<?php require_once('./functions/functions.php'); 

if(session_status() == PHP_SESSION_NONE){
    //session has not started
    session_start();
}

$user = array();

if( isset( $_SESSION['user'] ) ) {
	$user = $_SESSION['user'];
}

?>

	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="<?php echo BASE_URL;?>"><img src="img/logo.png" alt=""></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
							<li class="nav-item <?php echo isMenuActive(''); ?>"><a class="nav-link" href="<?php echo BASE_URL; ?>">Home</a></li>
							<li class="nav-item <?php echo isMenuActive('shop'); ?>"><a class="nav-link" href="<?php echo BASE_URL; ?>shop">Shop</a></li>
							<!--
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Shop</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="category.html">Shop Category</a></li>
									<li class="nav-item"><a class="nav-link" href="single-product.html">Product Details</a></li>
									<li class="nav-item"><a class="nav-link" href="checkout.html">Product Checkout</a></li>
									<li class="nav-item"><a class="nav-link" href="cart.html">Shopping Cart</a></li>
									<li class="nav-item"><a class="nav-link" href="confirmation.html">Confirmation</a></li>
								</ul>
							</li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Blog</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
									<li class="nav-item"><a class="nav-link" href="single-blog.html">Blog Details</a></li>
								</ul>
							</li>
							-->
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Account( <?php echo empty($user) ? 'Guest' : (!empty($user['customer_billing_firstname']) ? $user['customer_billing_firstname'] : $user['customer_username']); ?> )</a>
								<ul class="dropdown-menu">
									<?php if(empty($user)){ ?>
										<li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>login">Login</a></li>
									<?php }else{ ?>
										<li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>myorders">My Orders</a></li>
										<li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>logout">Logout</a></li>
									<?php } ?>

								</ul>
							</li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="nav-item"><a href="<?php echo BASE_URL; ?>cart" class="cart"><span class="ti-bag"></span></a></li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div class="search_input" id="search_input_box">
			<div class="container">
				<form class="d-flex justify-content-between">
					<input type="text" class="form-control" id="search_input" placeholder="Search Here">
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
				</form>
			</div>
		</div>
	</header>
	<!-- End Header Area -->
	
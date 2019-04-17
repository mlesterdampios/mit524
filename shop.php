<?php require_once('functions/functions.php'); 

session_start();

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
					<h1>Shop Category page</h1>
					<nav class="d-flex align-items-center">
						<a href="<?php echo BASE_URL; ?>">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Shop</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Browse Categories</div>
					<ul class="main-categories">
						<?php getCategories(); ?>
					</ul>
				</div>
				<div class="sidebar-filter mt-50">
					<div class="top-filter-head">Product Filters</div>
					<div class="common-filter">
						<div class="head">Brands</div>
						<form action="#">
							<ul>
								<?php getBrands(); ?>
							</ul>
						</form>
					</div>
				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting">
						<select id="sorting_id">
							<?php getSorting(); ?>
						</select>
					</div>
					<div class="sorting mr-auto">
						<select id="limit">
							<option value="10">Show 10</option>
							<option value="20">Show 20</option>
							<option value="30">Show 30</option>
						</select>
					</div>
					<div class="pagination">
						<?php getPagination(); ?>
					</div>
				</div>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						<!-- single product -->
						<?php getProducts();?>
				</section>
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting mr-auto">
						<select id="limit_1">
							<option value="10">Show 10</option>
							<option value="20">Show 20</option>
							<option value="30">Show 30</option>
						</select>
					</div>
					<div class="pagination">
						<?php getPagination(); ?>
					</div>
				</div>
				<!-- End Filter Bar -->
			</div>
		</div>
	</div>
	<!-- End brand Area -->

	<?php include_once('includes/footer.php'); ?>
	<?php updateNiceSelect('sorting_id','orderby', 1); ?>
	<?php updateNiceSelect('limit','limit', 10); ?>
	<?php updateNiceSelect('limit_1','limit', 10); ?>
	<script>
	function appendGet(url, pK, pP){
		console.log(url+", "+pK+", "+pP);
		var k;
		var p={};
		location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(s,k,v){p[k]=v})
		var currUrl = k?p[k]:p;
		//console.log(currUrl);
		//console.log(currUrl[pK] +"!="+ pP);
		if(currUrl[pK] != pP && Number.isInteger(pP)){
			currUrl[pK] = pP;
			var str = jQuery.param(currUrl);
			window.location = '<?php echo BASE_URL."shop?"; ?>' + str;
		}
	}

	$( "#limit" )
	.change(function () {
		var str = "";
		$( "#limit option:selected" ).each(function() {
			str = $( this ).val();
		});
		appendGet('shop', 'limit', parseInt(str));
	});
	$( "#limit_1" )
	.change(function () {
		var str = "";
		$( "#limit_1 option:selected" ).each(function() {
			str = $( this ).val();
		});
		appendGet('shop', 'limit', parseInt(str));
	});
	$( "#sorting_id" )
	.change(function () {
		var str;
		$( "#sorting_id option:selected" ).each(function() {
		str = $( this ).val();
		});
		appendGet('shop', 'orderby', parseInt(str));
	});

	</script>
 
</body>

</html>
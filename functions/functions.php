<?php
require_once('config.php');
//$query1=mysqli_query($con, "SELECT * FROM product WHERE product_desc = '{$product_desc}', qty='{$qty}'");
function getConnection(){
    $con = mysqli_connect(HOST,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
    return $con;
}


//get product on product.php
function getProduct(){
    $con = getConnection();
    $id = (int) (isset($_GET["id"]) && is_numeric($_GET["id"])) ? $_GET["id"] : false;
    if(!$id){
        header("Location: ".BASE_URL);
    }
	$stringQuery_getProducts="select p.*, category_name, brand_name from tbl_products p, tbl_brands b, tbl_categories c where p.brand_id = b.id and p.category_id = c.id and p.id = ".mysqli_real_escape_string($con, $id).";";
    $query_getProducts=mysqli_query($con, $stringQuery_getProducts);
    $product = null;
    if (mysqli_num_rows($query_getProducts) > 0) {
        While ($row_Products=mysqli_fetch_array($query_getProducts)){
            $product = $row_Products;
        }
    }
    return $product;
}
//get orders
function getOrderDetails($id, $user){
    $con = getConnection();
    $stringQuery_getPayments="select * from tbl_payments where id = ".mysqli_real_escape_string($con, $id)." and user_id = ".mysqli_real_escape_string($con, $user['id'])." order by id desc;";
    $query_getPayments=mysqli_query($con, $stringQuery_getPayments);
    $payments = null;
	While ($row_Payments=mysqli_fetch_array($query_getPayments)){
        $payments = $row_Payments;
    }
    return $payments;
}
//get orders
function getPayments($user_id){
    $con = getConnection();
	$stringQuery_getPayments="select * from tbl_payments where user_id = ".mysqli_real_escape_string($con, $user_id)." order by id desc;";
    $query_getPayments=mysqli_query($con, $stringQuery_getPayments);
    $payments = array();
	While ($row_Payments=mysqli_fetch_array($query_getPayments)){
        array_push($payments,$row_Payments);
    }
    return $payments;
}

//get orders
function getOrders($payment_id){
    $con = getConnection();
    $stringQuery_getOrders="select o.*, p.product_image, p.product_name, p.product_price  from tbl_orders o, tbl_products p where o.payment_id = ".mysqli_real_escape_string($con, $payment_id)." and o.product_id=p.id;";
    $query_getOrders=mysqli_query($con, $stringQuery_getOrders);
    $orders = array();
	While ($row_Orders=mysqli_fetch_array($query_getOrders)){
        array_push($orders,$row_Orders);
    }
    return $orders;
}

//get categories on shop.php
function getCategories(){
    $con = getConnection();
	$stringQuery_getCategories="select * from tbl_categories;";
    $query_getCategories=mysqli_query($con, $stringQuery_getCategories);
    if(isset($_GET['cat_id']) && !empty($_GET['cat_id'])){
        $cat_id = (int)$_GET['cat_id'];
    }
	While ($row_Categories=mysqli_fetch_array($query_getCategories)){
		$category_id=$row_Categories['id'];
        $category_name=$row_Categories['category_name'];
	    Echo "<li class='main-nav-list'><a href='".appendGet('shop','cat_id', $category_id)."' ><span class='lnr lnr-arrow-right'></span>$category_name</a></li>";
    }
}

//get countdownjs on shop.php
function getCountdownJS(){
	return '<script src="js/countdown.js"></script>';
}

//get brands on shop.php
function getBrands(){
    $con = getConnection();
	$stringQuery_getBrands="select * from tbl_brands;";
	$query_getBrands=mysqli_query($con, $stringQuery_getBrands);
	While ($row_Brands=mysqli_fetch_array($query_getBrands)){
		$brand_id=$row_Brands['id'];
        $brand_name=$row_Brands['brand_name'];
        $pbrand_id = (int) (isset($_GET['brand_id']) && !empty($_GET['brand_id'])) ? $_GET["brand_id"] : null;
        $isChecked = ($pbrand_id==$brand_id) ? ' checked ' : null;
        Echo '<li class="filter-list"><input '.$isChecked.' onclick="location.href=\''.appendGet('shop','brand_id', $brand_id).'\';" class="pixel-radio" type="radio" id="'.$brand_id.'" name="brand"><label>'.$brand_name.'</label></li>';
    }
}

//update nice-select on shop.php
function updateNiceSelect($component, $get, $default){
    $val = (int) (isset($_GET[$get]) && !empty($_GET[$get])) ? $_GET[$get] : $default;
    if(is_numeric($val)){
        echo '<script>$("#'.$component.'").val('.$val.').niceSelect("update");</script>';
    }
}

//get product soring on shop.php
function getSorting(){
	for($i = 1; $i <= 3; $i++){
        if($i==1){
            echo '<option value="1">Release Date</option>';
        }
        if($i==2){
            echo '<option value="2">Alphabetical</option>';
        }
        if($i==3){
            echo '<option value="3">Price</option>';
        }
    }
}

//check if page is currently browsed on footer.php
function isUrlActive($url){
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);

    if($uri_segments[2]==$url){
        return true;
    }
    return false;
}

//check if menu is currently selected on menu.php
function isMenuActive($menu){
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);

    if($uri_segments[2]==$menu){
        return 'active';
    }
}

//append get function
function appendGet($url, $key, $val){
    $params = $_GET;
    unset( $params[$key] );
    $params[$key]   = $val;
    $new_query_string = http_build_query( $params );
    
    return BASE_URL.$url.'?'.$new_query_string;
}

function getPagination(){
    $con = getConnection();
    //where
    $paramCount = 0;
    $stringQuery_getProducts = "select * from tbl_products where ";
    if(isset($_GET['cat_id']) && !empty($_GET['cat_id'] && is_numeric($_GET["cat_id"]))){
        $cat_id = (int)$_GET['cat_id'];
        if($paramCount > 0){
            $stringQuery_getProducts .= " and ";
        }
        $stringQuery_getProducts .= " category_id = ".mysqli_real_escape_string($con, $cat_id)." ";
        $paramCount++;
    }
    if(isset($_GET['brand_id']) && !empty($_GET['brand_id'] && is_numeric($_GET["brand_id"]))){
        $brand_id = (int)$_GET['brand_id'];
        if($paramCount > 0){
            $stringQuery_getProducts .= " and ";
        }
        $stringQuery_getProducts .=" brand_id = ".mysqli_real_escape_string($con, $brand_id)." ";
    }

    $stringQuery_getProducts .= " and product_isdeleted = 0 ";

    if($paramCount == 0){
        $stringQuery_getProducts = "select * from tbl_products where product_isdeleted = 0 ";
    }

    $limit = (int) (isset($_GET["limit"]) && is_numeric($_GET["limit"])) ? $_GET["limit"] : 10;
    $page = (int) (isset($_GET["page"]) && is_numeric($_GET["page"])) ? $_GET["page"] : 1;
    $query_getProducts=mysqli_query($con, $stringQuery_getProducts);
    $itemCount = 0;
	While ($row_getProducts=mysqli_fetch_array($query_getProducts)){
		$itemCount++;
    }

    $pages = $itemCount / $limit + (($itemCount % $limit > 0)? 1 : 0);
    $pages = ($pages>=1) ? (int)$pages : 1; 
    
    $i = 1;
    if($page - 1 > 0){
        $i = $page - 1;
        if($page - 2 > 0){
            $i = $page - 2;
            if($page - 3 > 0){
                $i = $page - 3;
            }
        }
    }
    if($page > 1){
        echo '<a href="'.appendGet('shop','page', $page-1).'" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>';
    }
    for(; $i <= $pages; $i++){
        $isActive = ($page==$i) ? 'active' : null;
        //var_dump ($pages > 3 && $pages == $i);
        if($i==$page-1){
            echo '<a href="'.appendGet('shop','page', $i).'" class="'.$isActive.'">'.$i.'</a>';
        }else if($i==$page){
            echo '<a href="'.appendGet('shop','page', $i).'" class="'.$isActive.'">'.$i.'</a>';
        }else if($i==$page+1){
            echo '<a href="'.appendGet('shop','page', $i).'" class="'.$isActive.'">'.$i.'</a>';
        }else if($pages > $page+2 && $i==$page+2){
            echo '<a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>';
        }else if($pages > $page+1 && $pages == $i){
            echo '<a href="'.appendGet('shop','page', $i).'" class="'.$isActive.'">'.$i.'</a>';
        }
    }
    if($page < $pages){
        echo '<a href="'.appendGet('shop','page', $page+1).'" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>';
    }

}


//get products on shop.php
function getProducts(){

    $con = getConnection();
    //where
    $paramCount = 0;
    $stringQuery_getProducts = "select * from tbl_products where ";
    if(isset($_GET['cat_id']) && !empty($_GET['cat_id'] && is_numeric($_GET["cat_id"]))){
        $cat_id = (int)$_GET['cat_id'];
        if($paramCount > 0){
            $stringQuery_getProducts .= " and ";
        }
        $stringQuery_getProducts .= " category_id = ".mysqli_real_escape_string($con, $cat_id)." ";
        $paramCount++;
    }
    if(isset($_GET['brand_id']) && !empty($_GET['brand_id'] && is_numeric($_GET["brand_id"]))){
        $brand_id = (int)$_GET['brand_id'];
        if($paramCount > 0){
            $stringQuery_getProducts .= " and ";
        }
        $stringQuery_getProducts .=" brand_id = ".mysqli_real_escape_string($con, $brand_id)." ";
    }

    $stringQuery_getProducts .= " and product_isdeleted = 0 ";

    if($paramCount == 0){
        $stringQuery_getProducts = "select * from tbl_products where product_isdeleted = 0 ";
    }

    //order by
    $stringQuery_getProducts .= " order by ";
    if(isset($_GET['orderby']) && !empty($_GET['orderby'] && is_numeric($_GET["orderby"]))){
        $orderby = $_GET['orderby'];
        if($orderby==1){
            $stringQuery_getProducts .=" ".mysqli_real_escape_string($con, 'date_created')." desc ";
        }else if($orderby==2){
            $stringQuery_getProducts .=" ".mysqli_real_escape_string($con, 'product_name')." asc ";
        }else if($orderby==3){
            $stringQuery_getProducts .=" ".mysqli_real_escape_string($con, 'product_price')." asc ";
        }else{
            $stringQuery_getProducts .=" ".mysqli_real_escape_string($con, 'date_created')." desc ";
        }
    }else{
        $stringQuery_getProducts .=" ".mysqli_real_escape_string($con, 'date_created')." desc ";
    }

    //limit
    $limit = (int) (isset($_GET["limit"]) && is_numeric($_GET["limit"])) ? $_GET["limit"] : 10;
    $page = (int) (isset($_GET["page"]) && is_numeric($_GET["page"])) ? $_GET["page"] : 1;
    $startpoint = ($page * $limit) - $limit;
    $stringQuery_getProducts .=" LIMIT ".mysqli_real_escape_string($con, $startpoint)." , ".mysqli_real_escape_string($con, $limit).";";

	$query_getProducts=mysqli_query($con, $stringQuery_getProducts);
	While ($row_getProducts=mysqli_fetch_array($query_getProducts)){
		$product_id=$row_getProducts['id'];
        $product_name=$row_getProducts['product_name'];
        $product_price=$row_getProducts['product_price'];
        $product_image=$row_getProducts['product_image'];
        $productImage = ($product_image!=null && !empty($product_image)) ? "<img class='img-fluid' src='".BASE_URL.'uploads/products/'.$product_image."' alt='Product Image'>" : 
        "<img class='img-fluid' src='".BASE_URL.'uploads/products/default.jpg'."' alt='Product Image'>";
	    Echo "<div class='col-lg-4 col-md-6'>
        <div class='single-product'>".$productImage."
            <div class='product-details'>
                <h6>$product_name</h6>
                <div class='price'>
                    <h6>&#8369;$product_price</h6>
                </div>
                <div class='prd-bottom'>
                    <a href='".BASE_URL.'product?id='.$product_id."' class='social-info'>
                        <span class='lnr lnr-move'></span>
                        <p class='hover-text'>view more</p>
                    </a>
                </div>
            </div>
        </div>
    </div>";
    }
}

//get products on index.php
function getProductsHome(){

    $con = getConnection();

    $stringQuery_getProducts = "select * from tbl_products where ";

    $stringQuery_getProducts .= " product_isdeleted = 0 ";

    //limit
    $limit = (int) (isset($_GET["limit"]) && is_numeric($_GET["limit"])) ? $_GET["limit"] : 6;
    $page = (int) (isset($_GET["page"]) && is_numeric($_GET["page"])) ? $_GET["page"] : 1;
    $startpoint = ($page * $limit) - $limit;
    $stringQuery_getProducts .=" LIMIT ".mysqli_real_escape_string($con, $startpoint)." , ".mysqli_real_escape_string($con, $limit).";";

	$query_getProducts=mysqli_query($con, $stringQuery_getProducts);
	While ($row_getProducts=mysqli_fetch_array($query_getProducts)){
		$product_id=$row_getProducts['id'];
        $product_name=$row_getProducts['product_name'];
        $product_price=$row_getProducts['product_price'];
        $product_image=$row_getProducts['product_image'];
        $productImage = ($product_image!=null && !empty($product_image)) ? "<img class='img-fluid' src='".BASE_URL.'uploads/products/'.$product_image."' alt='Product Image'>" : 
        "<img class='img-fluid' src='".BASE_URL.'uploads/products/default.jpg'."' alt='Product Image'>";
	    Echo "<div class='col-lg-4 col-md-6'>
        <div class='single-product'>".$productImage."
            <div class='product-details'>
                <h6>$product_name</h6>
                <div class='price'>
                    <h6>&#8369;$product_price</h6>
                </div>
                <div class='prd-bottom'>
                    <a href='".BASE_URL.'product?id='.$product_id."' class='social-info'>
                        <span class='lnr lnr-move'></span>
                        <p class='hover-text'>view more</p>
                    </a>
                </div>
            </div>
        </div>
    </div>";
    }
}

function getProductsHomeExclusive(){

    $con = getConnection();

    $stringQuery_getProducts = "select * from tbl_products where ";

    $stringQuery_getProducts .= " product_isdeleted = 0 order by rand()";

    //limit
    $limit = (int) (isset($_GET["limit"]) && is_numeric($_GET["limit"])) ? $_GET["limit"] : 6;
    $page = (int) (isset($_GET["page"]) && is_numeric($_GET["page"])) ? $_GET["page"] : 1;
    $startpoint = ($page * $limit) - $limit;
    $stringQuery_getProducts .=" LIMIT ".mysqli_real_escape_string($con, $startpoint)." , ".mysqli_real_escape_string($con, $limit).";";

	$query_getProducts=mysqli_query($con, $stringQuery_getProducts);
	While ($row_getProducts=mysqli_fetch_array($query_getProducts)){
		$product_id=$row_getProducts['id'];
        $product_name=$row_getProducts['product_name'];
        $product_price=$row_getProducts['product_price'];
        $product_image=$row_getProducts['product_image'];
        $productImage = ($product_image!=null && !empty($product_image)) ? "<img class='img-fluid' src='".BASE_URL.'uploads/products/'.$product_image."' alt='Product Image'>" : 
        "<img class='img-fluid' src='".BASE_URL.'uploads/products/default.jpg'."' alt='Product Image'>";
    echo "<div class='single-exclusive-slider'>
    ".$productImage."
    <div class='product-details'>
        <div class='price'>
            <h6>&#8369;$product_price</h6>
        </div>
        <h4>$product_name</h4>
        <div class='add-bag d-flex align-items-center justify-content-center'>
            <a class='add-btn' href='".BASE_URL.'product?id='.$product_id."'><span class='ti-bag'></span></a>
            <span class='add-text text-uppercase'>View More</span>
        </div>
    </div>
</div>";
    }
}

function getProductsFooter(){

    $con = getConnection();

    $stringQuery_getProducts = "select * from tbl_products where ";

    $stringQuery_getProducts .= " product_isdeleted = 0 order by rand()";

    //limit
    $limit = (int) (isset($_GET["limit"]) && is_numeric($_GET["limit"])) ? $_GET["limit"] : 9;
    $page = (int) (isset($_GET["page"]) && is_numeric($_GET["page"])) ? $_GET["page"] : 1;
    $startpoint = ($page * $limit) - $limit;
    $stringQuery_getProducts .=" LIMIT ".mysqli_real_escape_string($con, $startpoint)." , ".mysqli_real_escape_string($con, $limit).";";

	$query_getProducts=mysqli_query($con, $stringQuery_getProducts);
	While ($row_getProducts=mysqli_fetch_array($query_getProducts)){
		$product_id=$row_getProducts['id'];
        $product_name=$row_getProducts['product_name'];
        $product_price=$row_getProducts['product_price'];
        $product_image=$row_getProducts['product_image'];
        $productImage = ($product_image!=null && !empty($product_image)) ? "<img src='".BASE_URL.'uploads/products/'.$product_image."' alt='Product Image' style='max-width: 70px; max-height: 70px;'>" : 
        "<img src='".BASE_URL.'uploads/products/default.jpg'."' alt='Product Image' style='max-width: 70px; max-height: 70px;'>";
echo "<div class='col-lg-4 col-md-4 col-sm-6 mb-20'>
<div class='single-related-product d-flex'>
    <a href='".BASE_URL.'product?id='.$product_id."'>.$productImage</a>
    <div class='desc'>
        <a href='".BASE_URL.'product?id='.$product_id."' class='title'>$product_name</a>
        <div class='price'>
            <h6>&#8369;$product_price</h6>

        </div>
    </div>
</div>
</div>";
    }
}

function setCustomer($post, $id = null){
    $con = getConnection();
    if($id==null){
        $sql = "INSERT INTO tbl_customers (customer_username, customer_password, customer_billing_firstname, customer_billing_lastname, customer_billing_companyname, customer_billing_phonenumber, customer_billing_country, customer_billing_address1, customer_billing_address2, customer_billing_towncity, customer_billing_zip)
        VALUES ('".mysqli_real_escape_string($con, $post['customer_username'])."', '".md5(mysqli_real_escape_string($con, $post['customer_password']))."', '".mysqli_real_escape_string($con, $post['customer_billing_firstname'])."','".mysqli_real_escape_string($con, $post['customer_billing_lastname'])."', '".mysqli_real_escape_string($con, $post['customer_billing_companyname'])."', '".mysqli_real_escape_string($con, $post['customer_billing_phonenumber'])."', '".mysqli_real_escape_string($con, $post['customer_billing_country'])."', '".mysqli_real_escape_string($con, $post['customer_billing_address1'])."', '".mysqli_real_escape_string($con, $post['customer_billing_address2'])."', '".mysqli_real_escape_string($con, $post['customer_billing_towncity'])."', '".mysqli_real_escape_string($con, $post['customer_billing_zip'])."')";
        if (mysqli_query($con, $sql)) {
            return mysqli_insert_id($con);
        }
    }else if($id!=null){
        $sql = "update tbl_customers set  customer_billing_firstname = '".mysqli_real_escape_string($con, $post['customer_billing_firstname'])."', customer_billing_lastname = '".mysqli_real_escape_string($con, $post['customer_billing_lastname'])."', customer_billing_companyname = '".mysqli_real_escape_string($con, $post['customer_billing_companyname'])."', customer_billing_phonenumber = '".mysqli_real_escape_string($con, $post['customer_billing_phonenumber'])."', customer_billing_country = '".mysqli_real_escape_string($con, $post['customer_billing_country'])."', customer_billing_address1 = '".mysqli_real_escape_string($con, $post['customer_billing_address1'])."', customer_billing_address2 = '".mysqli_real_escape_string($con, $post['customer_billing_address2'])."', customer_billing_towncity = '".mysqli_real_escape_string($con, $post['customer_billing_towncity'])."', customer_billing_zip = '".mysqli_real_escape_string($con, $post['customer_billing_zip'])."' where id = ".mysqli_real_escape_string($con, $id).";";
        if (mysqli_query($con, $sql)) {
            return $id;
        }
    }
    return false;
}

function setPayment($post, $user_id){
    $con = getConnection();
    if($user_id!=null){
        $sql = "INSERT INTO tbl_payments (user_id, payment_mode_name, payment_total_price, payment_billing_firstname, payment_billing_lastname, payment_billing_companyname, payment_billing_phonenumber, payment_billing_country, payment_billing_address1, payment_billing_address2, payment_billing_towncity, payment_billing_zip)
        VALUES (".mysqli_real_escape_string($con, $user_id).", '".mysqli_real_escape_string($con, $post['payment_mode_name'])."', ".mysqli_real_escape_string($con, $post['payment_total_price']).", '".mysqli_real_escape_string($con, $post['customer_billing_firstname'])."','".mysqli_real_escape_string($con, $post['customer_billing_lastname'])."', '".mysqli_real_escape_string($con, $post['customer_billing_companyname'])."', '".mysqli_real_escape_string($con, $post['customer_billing_phonenumber'])."', '".mysqli_real_escape_string($con, $post['customer_billing_country'])."', '".mysqli_real_escape_string($con, $post['customer_billing_address1'])."', '".mysqli_real_escape_string($con, $post['customer_billing_address2'])."', '".mysqli_real_escape_string($con, $post['customer_billing_towncity'])."', '".mysqli_real_escape_string($con, $post['customer_billing_zip'])."')";
        if (mysqli_query($con, $sql)) {
            return mysqli_insert_id($con);
        }
    }
    return false;
}

function setOrders($post, $payment_id){
    $con = getConnection();
    $isAllSuccess = true;
    foreach($post as $p){
        if($payment_id!=null){
            $sql = "INSERT INTO tbl_orders (payment_id, product_id, order_product_price)
            VALUES (".mysqli_real_escape_string($con, $payment_id).", ".mysqli_real_escape_string($con, $p['id']).", ".mysqli_real_escape_string($con, $p['product_price']).")";
            if (!mysqli_query($con, $sql)) {
                $isAllSuccess = false;
            }
        }
    }
    return $isAllSuccess;
}

function login($username, $password){
    $con = getConnection();
    $stringQuery_getCustomers="select * from tbl_customers where customer_username like '".mysqli_real_escape_string($con, $username)."' and customer_password like '".md5(mysqli_real_escape_string($con, $password))."'";
    $query_getCustomers=mysqli_query($con, $stringQuery_getCustomers);
    $customer = array();
	While ($row_Customers=mysqli_fetch_array($query_getCustomers)){
        $customer = $row_Customers;
        $_SESSION['user'] = $row_Customers;
    }
    if (!empty($customer)){
        return true;
    }
    return false;
}

function setCustomerSessionFromCheckout($id){
    $con = getConnection();
	$stringQuery_getCustomers="select * from tbl_customers where id=".mysqli_real_escape_string($con, $id);
    $query_getCustomers=mysqli_query($con, $stringQuery_getCustomers);
    $customer = array();
	While ($row_Customers=mysqli_fetch_array($query_getCustomers)){
        $customer = $row_Customers;
    }
    $_SESSION['user'] = $customer;

}

function destroyCartSession(){
    unset($_SESSION['cart_items']);
}

function placeOrder($order, $cart_products, $user){
    //var_dump($order);var_dump($cart_products);var_dump($user);die();
    $payment_total_price = 0;
    foreach($cart_products as $p){
        $payment_total_price += $p['product_price'];
    }
    $order['payment_total_price'] = $payment_total_price;
    $user_id = false;
    if(empty($user)){
        $user_id = setCustomer($order);
        if(!$user_id){
            return array("error"=> true, "message" => "Cannot create account. Please check inputs or account already existing.");
        }else{
            setCustomerSessionFromCheckout($user_id);
        }
    }else{
        $user_id = setCustomer($order, $user['id']);
        if(!$user_id){
            return array("error"=> true, "message" => "Cannot create account. Please check inputs or account already existing.");
        }else{
            setCustomerSessionFromCheckout($user_id);
        }
    }
    $order_id = setPayment($order, $user_id);
    if(!$order_id){
        return array("error"=> true, "message" => "Cannot place order. Please check inputs");
    }
    setOrders($cart_products, $order_id);
    destroyCartSession();
    header ("Location: ".BASE_URL.'myorders?show_id='.$order_id);
}
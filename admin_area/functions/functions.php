<?php
require_once('config.php');

function getConnection(){
    $con = mysqli_connect(HOST,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
    return $con;
}

//get categories on /product/edit and /product/add
function getCategories($cat_id = null){
    $con = getConnection();
	$stringQuery_getCategories="select * from tbl_categories;";
    $query_getCategories=mysqli_query($con, $stringQuery_getCategories);
	While ($row_Categories=mysqli_fetch_array($query_getCategories)){
		$category_id=$row_Categories['id'];
        $category_name=$row_Categories['category_name'];
        $isSelected = ($cat_id==$category_id) ? 'selected' : null;
        echo "<option value='$category_id' $isSelected>$category_name</option>";
    }
}

//get brands on /product/edit and /product/add
function getBrands($pbrand_id = null){
    $con = getConnection();
	$stringQuery_getBrands="select * from tbl_brands;";
	$query_getBrands=mysqli_query($con, $stringQuery_getBrands);
	While ($row_Brands=mysqli_fetch_array($query_getBrands)){
		$brand_id=$row_Brands['id'];
        $brand_name=$row_Brands['brand_name'];
        $isSelected = ($brand_id==$pbrand_id) ? 'selected' : null;
        echo "<option value='$brand_id' $isSelected>$brand_name</option>";
    }
}

//get products on /product/index
function getProducts(){
    $con = getConnection();
	$stringQuery_getProducts="select product.*, product.id as product_id, brand.*, category.* from tbl_products product, tbl_brands brand, tbl_categories category where product.brand_id = brand.id and product.category_id = category.id and product.product_isdeleted = 0;";
    $query_getProducts=mysqli_query($con, $stringQuery_getProducts);
	While ($row_Products=mysqli_fetch_array($query_getProducts)){
		$product_id=$row_Products['product_id'];
        $product_name=$row_Products['product_name'];
        $brand_name=$row_Products['brand_name'];
        $category_name=$row_Products['category_name'];
        $product_price=$row_Products['product_price'];
        $product_isavailable=$row_Products['product_isavailable'];
        $product_isavailable = ($product_isavailable) ? "Yes" : "No";
        $edit_link = BASE_URL.'pages/product/edit?id='.$product_id;
        $delete_link = BASE_URL.'pages/product/delete?id='.$product_id;
	    Echo "<tr>
        <td>$product_id</td>
        <td>$category_name</td>
        <td>$brand_name</td>
        <td>$product_name</td>
        <td>$product_price</td>
        <td>$product_isavailable</td>
        <td>
        <a href='$edit_link' class='btn btn-outline-primary btn-fw'><i class='mdi mdi-file-check'></i></a>
        <a href='$delete_link' class='btn btn-outline-danger btn-fw'><i class='mdi mdi-delete'></i></a>
        </td>
    </tr>";
    }
}

//get products on /product/edit
function getProductByID($id){
    $con = getConnection();
    $stringQuery_getProducts="select * from tbl_products where product_isdeleted = 0 and id = ".mysqli_real_escape_string($con, $id).";";

    $query_getProducts=mysqli_query($con, $stringQuery_getProducts);
    $ret = array();
	While ($row_Products=mysqli_fetch_array($query_getProducts)){
        $ret['product_id'] = $row_Products['id'];
        $ret['product_name'] = $row_Products['product_name'];
        $ret['product_shortdescription'] = $row_Products['product_shortdescription'];
        $ret['brand_id'] = $row_Products['brand_id'];
        $ret['category_id'] = $row_Products['category_id'];
        $ret['product_price'] = $row_Products['product_price'];
        $ret['product_isavailable'] = $row_Products['product_isavailable'];
        $ret['product_wysiwyg_description'] = $row_Products['product_wysiwyg_description'];
        $ret['product_image'] = $row_Products['product_image'];
    }
    return $ret;
}

//set product on product/add and product/edit
function setProduct($post, $id = null){
    $con = getConnection();
    if($id==null){
        $sql = "INSERT INTO tbl_products (product_name, product_shortdescription, brand_id, category_id, product_price, product_isavailable, product_wysiwyg_description)
        VALUES ('".mysqli_real_escape_string($con, $post['product_name'])."', '".mysqli_real_escape_string($con, $post['product_shortdescription'])."', ".mysqli_real_escape_string($con, $post['brand_id']).",".mysqli_real_escape_string($con, $post['category_id']).", ".mysqli_real_escape_string($con, $post['product_price']).", ".mysqli_real_escape_string($con, $post['product_isavailable']).", '".mysqli_real_escape_string($con, $post['product_wysiwyg_description'])."')";
        if (mysqli_query($con, $sql)) {
            return mysqli_insert_id($con);
        }
    }else if($id!=null){
        $sql = "update tbl_products set product_name = '".mysqli_real_escape_string($con, $post['product_name'])."', product_shortdescription = '".mysqli_real_escape_string($con, $post['product_shortdescription'])."', brand_id = ".mysqli_real_escape_string($con, $post['brand_id']).", category_id = ".mysqli_real_escape_string($con, $post['category_id']).", product_price = ".mysqli_real_escape_string($con, $post['product_price']).", product_isavailable = ".mysqli_real_escape_string($con, $post['product_isavailable']).", product_wysiwyg_description = '".mysqli_real_escape_string($con, $post['product_wysiwyg_description'])."' where id = ".mysqli_real_escape_string($con, $id).";";
        if (mysqli_query($con, $sql)) {
            return $id;
        }
    }
    return false;
}

//set product on product/edit
function setProductImage($fileName, $id = null){
    $con = getConnection();
    if($id!=null){
        $sql = "update tbl_products set product_image = '".mysqli_real_escape_string($con, $fileName)."' where id = ".mysqli_real_escape_string($con, $id).";";
        if (mysqli_query($con, $sql)) {
            return $id;
        }
    }
    return false;
}

//delete product on product/delete
function deleteProduct($id){
    $con = getConnection();
    if($id!=null){
        $sql = "update tbl_products set product_isdeleted = 1 where id = ".mysqli_real_escape_string($con, $id).";";
        if (mysqli_query($con, $sql)) {
            return true;
        }
    }
    return false;
}

//get orders on /order/index
function getOrders(){
    $con = getConnection();
	$stringQuery_getOrders="select * from tbl_payments where payment_isdeleted = 0;";
    $query_getOrders=mysqli_query($con, $stringQuery_getOrders);
	While ($row_Orders=mysqli_fetch_array($query_getOrders)){
		$id=$row_Orders['id'];
        $payment_status=$row_Orders['payment_status'];
        $name=$row_Orders['payment_billing_firstname']." ".$row_Orders['payment_billing_lastname'];
        $payment_billing_address1=$row_Orders['payment_billing_address1'];
        $payment_total_price=$row_Orders['payment_total_price'];
        $payment_date=$row_Orders['payment_date'];
        $edit_link = BASE_URL.'pages/order/edit?id='.$id;
        $delete_link = BASE_URL.'pages/order/delete?id='.$id;
	    Echo "<tr>
        <td>$id</td>
        <td>$payment_status</td>
        <td>$name</td>
        <td>$payment_billing_address1</td>
        <td>$payment_total_price</td>
        <td>$payment_date</td>
        <td>
        <a href='$edit_link' class='btn btn-outline-primary btn-fw'><i class='mdi mdi-file-check'></i></a>
        <a href='$delete_link' class='btn btn-outline-danger btn-fw'><i class='mdi mdi-delete'></i></a>
        </td>
    </tr>";
    }
}

//get orders on /order/edit
function getOrderByID($id){
    $con = getConnection();
    $stringQuery_getOrders="select * from tbl_payments where payment_isdeleted = 0 and id = ".mysqli_real_escape_string($con, $id).";";

    $query_getOrders=mysqli_query($con, $stringQuery_getOrders);
    $ret = false;
	While ($row_Orders=mysqli_fetch_array($query_getOrders)){
        $ret = $row_Orders;
    }
    return $ret;
}

//get orders
function getOrderItems($payment_id){
    $con = getConnection();
    $stringQuery_getOrders="select o.*, p.product_image, p.product_name, p.product_price  from tbl_orders o, tbl_products p where o.payment_id = ".mysqli_real_escape_string($con, $payment_id)." and o.product_id=p.id;";
    $query_getOrders=mysqli_query($con, $stringQuery_getOrders);
	While ($row_Orders=mysqli_fetch_array($query_getOrders)){
        Echo "<tr>
        <td>".$row_Orders['product_id']."</td>
        <td>".$row_Orders['product_name']."</td>
        <td>".$row_Orders['order_product_price']."</td>
    </tr>";
    }
}

//set order on order/add and order/edit
function setOrder($post, $id = null){
    $con = getConnection();
    if($id==null){
        $sql = "INSERT INTO tbl_payments (payment_status)
        VALUES ('".mysqli_real_escape_string($con, $post['payment_status'])."')";
        if (mysqli_query($con, $sql)) {
            return mysqli_insert_id($con);
        }
    }else if($id!=null){
        $sql = "update tbl_payments set payment_status = '".mysqli_real_escape_string($con, $post['payment_status'])."' where id = ".mysqli_real_escape_string($con, $id).";";
        if (mysqli_query($con, $sql)) {
            return $id;
        }
    }
    return false;
}

//delete order on order/delete
function deleteOrder($id){
    $con = getConnection();
    if($id!=null){
        $sql = "update tbl_payments set payment_isdeleted = 1 where id = ".mysqli_real_escape_string($con, $id).";";
        if (mysqli_query($con, $sql)) {
            return true;
        }
    }
    return false;
}

//get customers on /customer/index
function getCustomers(){
    $con = getConnection();
	$stringQuery_getCustomers="select * from tbl_customers;";
    $query_getCustomers=mysqli_query($con, $stringQuery_getCustomers);
	While ($row_Customers=mysqli_fetch_array($query_getCustomers)){
		$id=$row_Customers['id'];
        $name=$row_Customers['customer_billing_firstname']." ".$row_Customers['customer_billing_lastname'];
        $customer_bbilling_address1=$row_Customers['customer_billing_address1'];
        $customer_billing_country=$row_Customers['customer_billing_country'];
        $customer_billing_phonenumber=$row_Customers['customer_billing_phonenumber'];
        $date_created=$row_Customers['date_created'];
        $edit_link = BASE_URL.'pages/customer/edit?id='.$id;
	    Echo "<tr>
        <td>$id</td>
        <td>$name</td>
        <td>$customer_bbilling_address1</td>
        <td>$customer_billing_country</td>
        <td>$customer_billing_phonenumber</td>
        <td>$date_created</td>
        <td>
        <a href='$edit_link' class='btn btn-outline-primary btn-fw'><i class='mdi mdi-file-check'></i></a>
        </td>
    </tr>";
    }
}

//get customers on /customer/edit
function getCustomerByID($id){
    $con = getConnection();
    $stringQuery_getCustomers="select * from tbl_customers where id = ".mysqli_real_escape_string($con, $id).";";

    $query_getCustomers=mysqli_query($con, $stringQuery_getCustomers);
    $ret = false;
	While ($row_Customers=mysqli_fetch_array($query_getCustomers)){
        $ret = $row_Customers;
    }
    return $ret;
}

//set customer on customer/add and customer/edit
function setCustomer($post, $id = null){
    $con = getConnection();
    if($id==null){
        $sql = "INSERT INTO tbl_customers (customer_isdeleted)
        VALUES ('".mysqli_real_escape_string($con, $post['customer_isdeleted'])."')";
        if (mysqli_query($con, $sql)) {
            return mysqli_insert_id($con);
        }
    }else if($id!=null){
        $sql = "update tbl_customers set customer_isdeleted = ".mysqli_real_escape_string($con, $post['customer_isdeleted'])." where id = ".mysqli_real_escape_string($con, $id).";";
        if (mysqli_query($con, $sql)) {
            return $id;
        }
    }
    return false;
}
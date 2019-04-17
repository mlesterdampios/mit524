<?php require_once('../../functions/functions.php'); 

session_start();

$admin = array();
if(isset( $_SESSION['admin']) && !empty($_SESSION['admin'])) {
    $admin = $_SESSION['admin'];
}else{
    header("Location: ".BASE_URL);
}


if ( isset($_GET['id']) && !empty($_GET['id'])) {
    $id = deleteProduct($_GET['id']);
    header("Location: ".BASE_URL."pages/product/index");
}

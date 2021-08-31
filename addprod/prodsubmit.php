<?php 

require_once("../model/db.class.php");
require_once("../model/product.class.php");

if($_SERVER['REQUEST_METHOD']=='POST'){


    $name = $_POST['name'];
    $vendor_id = $_POST['id'];
    $description = $_POST['description'];
    $country = $_POST['country'];

    $product = new Product();
    $product->add($name, $description, $country, $vendor_id);

        
    
    session_start();
    $_SESSION['product'] = 'تم إضافة بيانات السلعة';
    header("location: addprod.php");
    
}


?>
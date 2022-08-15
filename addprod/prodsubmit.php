<?php 

require_once("../model/db.class.php");
require_once("../model/product.class.php");
session_start();

if($_SERVER['REQUEST_METHOD']=='POST'){


    $name = htmlspecialchars(trim($_POST['name']));
    $vendor_id = htmlspecialchars(trim($_POST['id']));
    $description = htmlspecialchars(trim($_POST['description']));
    $country = htmlspecialchars(trim($_POST['country']));




    $product = new Product();

            if($product->checkDuplicate($name)){

                $_SESSION['duplicate'] = 'السلعة متكررة يرجى التحقق';
                header("location: addprod.php");

                } else {

                    $product->add($name, $description, $country, $vendor_id);
  
                    $_SESSION['product'] = 'تم إضافة بيانات السلعة';
                    header("location: addprod.php");

                }

    
    
}


?>
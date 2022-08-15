<?php 

include('../model/db.class.php');
include('../model/vendor.class.php');



if($_SERVER['REQUEST_METHOD']=='POST'){

    $company = htmlspecialchars(trim($_POST['company']));
    $manager = htmlspecialchars(trim($_POST['manager']));
    $address = htmlspecialchars(trim($_POST['address']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $email = htmlspecialchars(trim($_POST['email']));
    $website = htmlspecialchars(trim($_POST['website']));


    // session_start();
    // $_SESSION['vendor'] = '';

    
        $vendor = new Vendor();

        $vendor->add($company, $manager, $address, $phone, $email, $website);

        header("location: addvend.php");


    session_start();
    $_SESSION['vendor'] = 'تم إضافة بيانات المورّد';    
    
}


?>
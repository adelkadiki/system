<?php 

include('../model/db.class.php');
include('../model/vendor.class.php');



if($_SERVER['REQUEST_METHOD']=='POST'){

    $company = $_POST['company'];
    $manager = $_POST['manager'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $website = $_POST['website'];


    // session_start();
    // $_SESSION['vendor'] = '';

    
        $vendor = new Vendor();

        $vendor->add($company, $manager, $address, $phone, $email, $website);

        header("location: addvend.php");


    session_start();
    $_SESSION['vendor'] = 'تم إضافة بيانات المورّد';    
    
}


?>
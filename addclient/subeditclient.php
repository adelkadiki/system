<?php

require_once("../model/db.class.php");



if($_SERVER['REQUEST_METHOD']=='POST'){

    $id = $_POST['id'];
    $company = $_POST['company'];
    $manager = $_POST['manager'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    

    $db = new Database();
    $stm = $db->connect()->prepare("UPDATE client SET company=:company, 
    manager=:manager, address=:address, phone=:phone,
    email=:email, website=:website WHERE id=:id");
    $stm->bindValue(':id', $id);
    $stm->bindValue(':company', $company);
    $stm->bindValue(':manager', $manager);
    $stm->bindValue(':address', $address);
    $stm->bindValue(':phone', $phone);
    $stm->bindValue(':email', $email);
    $stm->bindValue(':website', $website);
    $stm->execute();


    // echo $id.'<br>';
    // echo $company.'<br>';
    // echo $manager.'<br>';
    // echo $website.'<br>';
    // echo $email.'<br>';

    header("location: clientdetails.php?id=".$id);


}

?>
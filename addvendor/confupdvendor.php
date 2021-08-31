<?php

include_once("../model/db.class.php");

if($_SERVER['REQUEST_METHOD']=='GET'){

$id = $_GET['id'];
$company = $_GET['company'];
$manger = $_GET['manager'];
$address = $_GET['address'];
$phone = $_GET['phone'];
$email = $_GET['email'];
$website = $_GET['website'];

$url = 'vendordetails.php?id='.$id;

// echo $id.'<br>';
// echo $company.'<br>';
// echo $phone.'<br>';
// echo $email.'<br>';

    $db = new Database();
    
$stm = $db->connect()->prepare("UPDATE vendor SET company=:company, manager=:manager, address=:address, phone=:phone, email=:email, website=:website 
WHERE id=:id");   
$stm->bindValue(':id', $id);
$stm->bindValue(':company', $company);
$stm->bindValue(':manager', $manger);
$stm->bindValue(':address', $address);
$stm->bindValue(':phone', $phone);
$stm->bindValue(':email', $email);
$stm->bindValue(':website', $website);
$stm->execute();   

}

header("Location: $url");

?>
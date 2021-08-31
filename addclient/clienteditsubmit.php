<?php 

include("../template/header.php"); 
require_once("../model/db.class.php");
require_once("../model/client.class.php");

if($_SERVER['REQUEST_METHOD']=='POST'){

$id = $_POST['id'];
$company = $_POST['company'];
$manager = $_POST['manager'];
$address = $_POST['address'];
$email = $_POST['email'];
$website = $_POST['website'];
$phone = $_POST['phone'];


$client = new Client();
$client->update($id, $company, $manager, $address, $email, $website, $phone);

    header("location: allclients.php");


}

?>
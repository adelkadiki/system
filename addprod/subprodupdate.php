<?php
include_once("../model/db.class.php");

if($_SERVER['REQUEST_METHOD']=='POST'){

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$country = $_POST['country'];


$db = new Database();
    
    $stm = $db->connect()->prepare("UPDATE product SET name=:name, description=:description, country=:country WHERE id=:id");
    $stm->bindValue(':id', $id);
    $stm->bindValue(':name', $name);
    $stm->bindValue(':description', $description);
    $stm->bindValue(':country', $country);
    $stm->execute();


}

header("Location: productdetails.php?id=$id");

?>
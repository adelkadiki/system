<?php 


include_once("../model/db.class.php");

$db = new Database();


    $id = $_GET['id'];
    // echo 'id  = '.$id;

    // echo 'delete page '.$id;

    try {

    $stm = $db->connect()->prepare("DELETE FROM purchasement WHERE id=:id");
    $stm->bindValue(':id', $id);
    $stm->execute();

    }catch(PDOException $e){
    
        echo $e->getMessage();
    }

    header("Location: mainpurch.php");



?>
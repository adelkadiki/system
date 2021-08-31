<?php 

include_once("../model/db.class.php");

if($_SERVER['REQUEST_METHOD']=='GET'){

    $id= $_GET['id'];

    $db = new Database();
    
    $stm = $db->connect()->prepare("DELETE FROM sales WHERE id=:id");    
    $stm->bindValue(':id', $id);
    $stm->execute();

    header("Location: sales.php"); 
}

?>
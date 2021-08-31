<?php
require_once("../model/db.class.php");


    $id = $_GET['id'];

    $db = new Database();
    $stm = $db->connect()->prepare("DELETE FROM client WHERE id=:id");
    $stm->bindValue(':id', $id);
    $stm->execute();

    header('Location: allclients.php');

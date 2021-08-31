<?php

require_once("model/db.class.php");

if($_SERVER['REQUEST_METHOD']=='POST'){

    $email = $_POST['email'];

    $response=0;
    
$db = new Database();
$stm= $db->connect()->prepare("SELECT * FROM user WHERE Email=:email");
$stm->bindValue(':email', $email);
$stm->execute();


while($row = $stm->fetch()){

    //echo $row['id'];
    $response = $row['id'];

}

echo $response;

}


?>
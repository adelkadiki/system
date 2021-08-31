<?php 

include_once("../model/db.class.php");


$db = new Database();
$stm = $db->connect()->prepare("SELECT id FROM client ORDER BY id DESC LIMIT 1");
$stm->execute();
        
        while($row = $stmpr->fetch()) { 
            
            echo $row['id'];
            
        }

?>
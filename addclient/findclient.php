<?php 

include_once("../model/db.class.php");

if($_SERVER['REQUEST_METHOD']=='POST'){

    $company = $_POST['company'];

    $result = true;

  $db = new Database();
    
  $stm = $db->connect()->prepare("SELECT id FROM client WHERE company=:company");   

  $stm->bindValue(':company', $company);
  
  $stm->execute();   

  if($stm->rowCount() > 0){

    $result = false;

  }

    
  echo $result;


}

?>
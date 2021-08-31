<?php 

include_once("../model/db.class.php");



    $id = $_POST['vendorid'] ?? '';
    
    
//     $comp='';
 $db = new Database();
 $stm = $db->connect()->prepare("SELECT id,name FROM product WHERE vendor_id=:id");
 $stm->bindValue(':id', $id);
 $stm->execute();

  while($row = $stm->fetch()){
  
   echo '<option value="'.$row['name'].'">'.$row['name'].' </option>';
//     $vid= $row['vendor_id'];
//     $vstm = $db->connect()->prepare("SELECT company FROM vendor WHERE id=:vid");
//     $vstm->bindValue(':vid', $vid);
//     $vstm->execute();

//     while($vrow = $vstm->fetch()){

//        $comp.=$vrow['company'];
//     }

  }

// echo $comp; 

?>
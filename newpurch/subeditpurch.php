<?php
require_once("../model/db.class.php");

$db = new Database();

if($_SERVER['REQUEST_METHOD']=='POST'){

    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    $unitprice = $_POST['unitprice'];
    $purchid = $_POST['purchid'];
    $id = $_POST['id'];
    $purch_id = $_POST['purch_id'];
    
    
    // echo 'product = '.$product.'<br>';
    // echo 'quantity = '.$quantity.'<br>';
    // echo 'unitprice = '.$unitprice.'<br>';
    // echo 'purch id = '.$purchid.'<br>';
    // echo 'id = '.$id.'<br>';
    
    $subtotal=0;
    $total=0;

    foreach($product as $key => $v){

        

        $stm= $db->connect()->prepare("UPDATE purchdetails SET product=:product, 
        quantity=:quantity, unitprice=:unitprice WHERE id=:id");
        $stm->bindValue(':product', $product[$key]);
        $stm->bindValue(':quantity', $quantity[$key]);
        $stm->bindValue(':unitprice', $unitprice[$key]);
        $stm->bindValue(':id', $id[$key]);
        $stm->execute();

        // echo $product[$key].'<br>';
        // echo $quantity[$key].'<br>';
        // echo $unitprice[$key].'<br>';

          $subtotal = $quantity[$key]*$unitprice[$key];
        //   echo 'sub total ='.$subtotal.'<br>';

          $total = $total+$subtotal;

    
    }

    // echo 'final total = '.$total.'<br>';
    // echo 'purch id = '.$purchid.'<br>';

    
    $stm= $db->connect()->prepare("UPDATE purchasement SET totalprice=:totalprice WHERE id=:id");
       
    $stm->bindValue(':totalprice', $total);
    $stm->bindValue(':id', $purchid);
    $stm->execute();

   
  header("Location: purchdetails.php?id=$purchid");

}


?>
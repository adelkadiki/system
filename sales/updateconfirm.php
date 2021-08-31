<?php

include_once("../model/db.class.php");


if($_SERVER['REQUEST_METHOD']=='POST'){

        $sales_id = $_POST['id'];
       
        
       
        $unitprice = $_POST['unitprice'];
        $quantity = $_POST['quantity'];
        $product = $_POST['product'];
       
        $total=0;
        $subtotal=0;

        $db = new Database();
        
         foreach($product as $key => $v) { 

          $subtotal = $quantity[$key] * $unitprice[$key] ;
          $total += $subtotal;    
    
        $stm = $db->connect()->prepare("UPDATE invoice SET unitprice=:unitprice , quantity=:quantity
        WHERE product=:product AND sales_id=:sales_id");    
       
        $stm->bindValue(':quantity', $quantity[$key]);
        $stm->bindValue(':unitprice', $unitprice[$key]);
        $stm->bindValue(':product', $product[$key]);
        $stm->bindValue(':sales_id', $sales_id);
        $stm->execute();   

         }

         $stms = $db->connect()->prepare("UPDATE sales SET payment=:payment
         WHERE id=:sales_id");    
         $stms->bindValue(':sales_id', $sales_id);
         $stms->bindValue(':payment', $total);
         $stms->execute();

         header('Location: invdetails.php?id='.$sales_id);
}

?>
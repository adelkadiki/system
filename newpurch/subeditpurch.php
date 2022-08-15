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
    
    
    $subtotal=0;
    $total=0;
    

    foreach($product as $key => $v){


                 

      // updating the pruchdetails table
        $stm= $db->connect()->prepare("UPDATE purchdetails SET product=:product, 
        quantity=:quantity, unitprice=:unitprice WHERE id=:id");
        $stm->bindValue(':product', trim($product[$key]));
        $stm->bindValue(':quantity', trim($quantity[$key]));
        $stm->bindValue(':unitprice', trim($unitprice[$key]));
        $stm->bindValue(':id', $id[$key]);
        $stm->execute();

        

          $subtotal = $quantity[$key]*$unitprice[$key];
        

          $total = $total+$subtotal;

          $stm2 = $db->connect()->prepare("UPDATE product SET quantity=quantity+:quantity
          WHERE name=:product");
          $stm2->bindValue(':product', trim($product[$key]));
          $stm2->bindValue(':quantity', trim($quantity[$key]));
          $stm2->execute();
            
          // $newQnt = 0; 
      
          //   $stm = $db->connect()->prepare("SELECT quantity FROM product WHERE name=:product");
          //   $stm->bindValue(':product', $product[$key]);
          //   $stm->execute();

          //   $row = $stm->fetch();

          //   $newQnt = $row['quantity'] - $quantity[$key];

          //           $stm2 = $db->connect()->prepare("UPDATE product SET quantity=:quantity 
          //           WHERE name=:product");
          //           $stm2->bindValue(':product', $product[$key]);
          //           $stm2->bindValue(':quantity', $quantity[$key]);
          //           $stm2->execute();      
      
                   
      
    }

     
    
     // updating the purchasment table values
    $stm= $db->connect()->prepare("UPDATE purchasement SET totalprice=:totalprice WHERE id=:id");
       
    $stm->bindValue(':totalprice', $total);
    $stm->bindValue(':id', $purchid);
    $stm->execute();

   
 // header("Location: purchdetails.php?id=$purchid");

 

}


?>
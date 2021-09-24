<?php

session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}

include_once("../model/db.class.php");
include("../template/header.php");

$page = $_SESSION['page'];


if($_SERVER['REQUEST_METHOD']=='POST'){

    $client_id= $_POST['client'];
    $quantity = $_POST['quantity'];
    $unitprice = $_POST['unitprice'];
    $product = $_POST['product'];
    $date = $_POST['date'];
    $client="";

   
        
        $db = new Database();
    
        $stmc = $db->connect()->prepare("SELECT company FROM client WHERE id=:id");    
        $stmc->bindValue(':id', $client_id);
        $stmc->execute();

        while($row = $stmc->fetch()){

            $client .= $row['company'];
        }
    

   

    $count=0;
    $subtotal=0;
    $total=0;

    ?>
<div class="container" style="padding-top:3%;">

 <h3 class="maintext">بيانات الفاتورة</h3>

<table class="table table-striped">
  <thead>
    <tr style="background-color:#cdcecc; font-weight:bold;" >
      <th scope="col">المجموع</th>
      <th scope="col">الكمية</th>
      <th scope="col">سعر الوحدة</th>
      <th scope="col">الوصف</th>
      <th scope="col">#</th>
    </tr>
  </thead>
  <tbody>
  <?php  foreach($product as $key => $v) { 
    
    $subtotal= $unitprice[$key]*$quantity[$key];
    $total += $subtotal;
    ?>
    <tr>
    
      
      <!-- right to left -->
      <td><?php echo $subtotal ?></td>
      <td><?php echo $quantity[$key]?></td>
      <td><?php echo $unitprice[$key]?></td>
      <td><?php echo $product[$key]?></td>
      <th scope="row"><?php echo $count +=1;?></th>
    </tr>
    <?php } ?>
    <tr style="background-color:#cdcecc;  font-weight:bold;" >
      <td><?php echo $total;?></td> <td></td> <td></td> <td></td><td>الإجمالي</td>
    </tr>
  </tbody>
</table>

</div>
    <?php    
        
       

          try{

        $db = new Database();
    
        $stm = $db->connect()->prepare("INSERT INTO sales(client, payment, date, client_id) 
        VALUES(:client, :payment, :date, :client_id)");   

        $stm->bindValue(':client', $client);
        $stm->bindValue(':payment', $total);
        $stm->bindValue(':date', $date);
        $stm->bindValue(':client_id', $client_id);
        $stm->execute();    

        $stms = $db->connect()->prepare("SELECT id FROM sales ORDER BY id DESC LIMIT 1");
        $stms->execute();
        
        while($row = $stms->fetch()) {

              $sales_id = $row['id']; 

        }

        }catch(PDOException $e){

            echo $e->getMessage();
        }
        
        //$url = 'delsales.php?id='.$sales_id;


        

        $url = 'delsales.php?id='.$sales_id;


        ?>
        
        

          <form action="confinvoice.php" method="post">

          <?php foreach($product as $key => $v){ ?>

          <input type="hidden" value="<?php echo $product[$key]; ?>" name="product[]" >
          
          <input type="hidden" value="<?php echo $unitprice[$key]; ?>" name="unitprice[]" >

          <input type="hidden" value="<?php echo $quantity[$key]; ?>" name="quantity[]" >

          <input type="hidden" value="<?php echo $sales_id ; ?>" name="salesid" >
          
          <input type="hidden" value="<?php echo $client; ?>" name="client" >

          <?php }   ?>

              <div class="row">
              <div class="col text-center">
              <button class="btn btn-success" style="width:120px; margin-bottom:2%;">تأكيد</button>    
              </div>
              </div>
          

          </form>

            <!-- <form action="delsales.php" method="get">
            <input type="hidden" value="<?php echo $sales_id?>" name="id">
           <div class="row">
            <div class="col text-center">
            <button class="btn btn-warning" style="width:120px;">إلغاء</button>
            </div>
           </div>
            
           
            </form><br><br> -->


            <div class="row">
              <div class="col text-center">
            <a href="<?php echo $url; ?>" class="btn btn-warning">إلغاء</a>
              </div>
              </div>

<?php
}
?>

<?php include("../template/footer.php");?>
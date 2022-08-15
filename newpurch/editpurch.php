<?php 
 require_once("../model/db.class.php");
 require("../template/header.php"); 

 

if($_SERVER['REQUEST_METHOD']=='POST'){

    $id = $_POST['id'];

    $db = new Database();
    
     //$productsList = array();
     $productsList = unserialize(base64_decode($_POST['jsonQnt']));
    
     
    
    
       // Deleting old quantities from product table

            foreach($productsList as $pr => $qnt){
            
                    
              try {
              
              $stmoq = $db->connect()->prepare("UPDATE product SET quantity=quantity-:qnt
              WHERE name=:name");
              $stmoq->bindValue(':name', $pr);
              $stmoq->bindValue(':qnt', $qnt);
              $stmoq->execute();        
              

            }catch(PDOException $e){

              echo $e->getMessage();
          }

            }


    $url = 'purchdetails.php?id='.$id;
   

    $prstm = $db->connect()->prepare("SELECT * FROM purchasement WHERE id=:id");
    $prstm->bindValue(':id', $id);
    $prstm->execute();

    while($prow=$prstm->fetch()){ ?>

<div class="container" style="padding-top:5%;">



<a href="<?php echo $url?>" class="btn btn-outline-primary btn-width">تفاصيل الطلبية</a>
<h3 class="maintext" >تعديل بيانات طلبية مشتريات</h3>
  <div class="rightwriting" >رقم الطلبية <?php echo $prow['id']; ?></div> 
  <div class="rightwriting">التاريخ <?php echo $prow['date']; ?></div> <br>
  <h5 class="rightwriting"> <?php echo $prow['vendor']; ?>  </h5>


<?php
 } 

    $stm = $db->connect()->prepare("SELECT * FROM purchdetails WHERE purch_id=:purch_id");
    $stm->bindValue(':purch_id', $id);
    $stm->execute();
?>

    

    <form action="subeditpurch.php" method="post">
    
    <table class="table table-striped">
    
  <thead>
    <tr>
      <th scope="col">المجموع</th>
      <th scope="col">سعر الوحدة</th>
      <th scope="col">الكمية</th>
      <th scope="col">الوصف</th>
      <th scope="col"></th>
      <th scope="col">#</th>
    </tr>
  </thead>
  
  <tbody>

  <?php 
  $count=0;
  $total=0; 

  while($row = $stm->fetch()){ ?>

    <tr>
    <input type="hidden" name="purch_id" value="<?php echo $id?>">
      <td> <?php echo $subtotal = $row['quantity']*$row['unitprice']; ?> </td>
      
      <td> <input name="unitprice[]" type="text" value="<?php echo $row['unitprice']; ?>"> </td>
      <td> <input name="quantity[]" type="text" value="<?php echo $row['quantity']; ?>"> </td>
      <td> <?php echo $row['product'];?> <input type="hidden" name="product[]" value=" <?php echo $row['product']; ?>" readonly> </td>
      <td><input type="hidden" name="id[]" value="<?php echo $row['id']; ?>"></td>
      <th scope="row"> <?php echo $count+=1; ?> </th>
    </tr>
    
    <?php $total = $total + $subtotal; 
        
    } 
    // echo $total;
    ?>

  </tbody>
</table>
    
    <input type="hidden" name="purchid" value="<?php echo $id ?>">
      
      <div class="col text-center" >
      <button class="btn btn-success btn-width" id="productUpt">تأكيد</button>
      </div>
      
    </form>

    

    </div><br><br>


    <div class="co text-center" >
<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#myModal">حذف طلبية الشراء</button>
</div>



<!-- confirm dialog -->
<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-body">
        <p style="text-align:center;" >هل تريد حذف طلبية الشراء ؟</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="productdelete" onclick="purchorderdelete(<?php echo $id ?>)" >إحذف</button>
        <button style="margin-left:65%;" type="button" class="btn btn-primary" data-dismiss="modal">تراجع</button>
      </div>
    </div>
  </div>
</div>
<!-- confirm dialog -->

 <?php }

require("../template/footer.php"); 

?>

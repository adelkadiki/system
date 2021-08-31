<?php

session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}

$page = $_SESSION['page'];

include_once("../model/db.class.php");
include("../template/header.php"); 

$id = $_GET['id'];

?>

<div class="container" style="padding-top:4%;">

<?php
$db = new Database();

$stm = $db->connect()->prepare("SELECT * FROM invoice WHERE sales_id=:id");   
$stm->bindValue(':id', $id);
$stm->execute();


$stms = $db->connect()->prepare("SELECT * FROM sales WHERE id=:id");   
$stms->bindValue(':id', $id);
$stms->execute();



?>
<a href="sales.php" class="btn btn-outline-primary" id="backto">قائمة المبيعات</a>  

<?php  while($rows = $stms->fetch()){ ?>


<div class="rightwriting" > <?php echo $rows['id']?> رقم الفاتورة  </div>
<div class="rightwriting" > <span style="font-weight: 950;" > <?php echo $rows['client']?> </span> الزبون</div>
<div class="rightwriting" > التاريخ <span style="font-weight: 950;"> <?php echo $rows['date'] ?> </span> </div>


<?php

}

?>



<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">المجموع</th>
      <th scope="col">الكمية</th>
      <th scope="col">سعر الوحدة</th>
      <th scope="col">الوصف</th>
      <th scope="col">#</th>
      
    </tr>
  </thead>
  <tbody>
     
  <?php 
  $count=0;
  $total=0;
  $subtotal=0;

  while($row = $stm->fetch()){ 
    
    $subtotal = $row['unitprice']*$row['quantity'];

      ?>

<form action="updateconfirm.php" method="post">

        <input type="hidden" value="<?php echo $id; ?>" name="id">
        <input type="hidden" name="product[]" value="<?php echo $row['product'];?>">
    <tr>
    
      <th><?php echo $subtotal; ?> </th>
      <td><input type="text" name="quantity[]" value="<?php echo $row['quantity']; ?>"></td>
     
      <td> <input type="text" name="unitprice[]" value="<?php echo $row['unitprice']; ?>"> </td>
     
      <td> <?php echo $row['product']; ?> </td>
     
      <td><?php echo $count+=1;?></td>
      
    </tr>

<?php 
    $total = $total + $subtotal;
} ?>    
    <tr style="font-weight: 950;">
        <td style="font-size:20px;"><?php echo $total; ?></td><td></td><td></td><td></td><td>الإجمالي</td>
    </tr>
  </tbody>

  </table>
  
<div class="col text-center" >
  <button style="width: 120px;" class="btn btn-success">تأكيد</button><br><br>
</div>


</form>
<div class="co text-center" >
<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#myModal">حذف الفاتورة</button>
</div>

<!-- confirm dialog -->
<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body">
        <p style="text-align:center;" >هل تريد حذف الفاتورة ؟</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="deletesales(<?php echo $id; ?>)">إحذف</button>
        <button style="margin-left:65%;" type="button" class="btn btn-primary" data-dismiss="modal">تراجع</button>
      </div>
    </div>
  </div>
</div>
<!-- confirm dialog -->

</div>


<?php include("../template/footer.php"); ?>
<?php 

session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}


$page = basename(__FILE__);
$_SESSION['page'] = $page;


include("../template/header.php"); 
require_once("../model/db.class.php");

$db = new Database();
$stm = $db->connect()->prepare("SELECT * FROM client");

$stm->execute();

?>

<div class="container invenv">
<h5 class="maintext" style="margin-top: 3%;">إصدار فاتورة جديدة</h5>
<a href="salesmain.php" class="btn btn-outline-primary" >صفحة المبيعات الرئيسية</a><br><br>

<div class="alert alert-danger text-right" id="numbers" role="alert" >
يرجي إدخال أرقام في خانة السعر و الكمية
</div>

<div class="alert alert-danger text-right" id="clientwarn" role="alert" >
يرجي إختيار إسم الزبون
</div>

<div class="alert alert-danger" id="duplicatewarn" role="alert" style="text-align:right;">
تم تكرار سلعة أكثر من مرة
</div>


<form method="post" action="subinvoice.php" onsubmit=" return newpurchsub()" id="newinvform">

<div class="form-group" >
<div class="text-right">
<label >العميل</label>
</div>    

    
    <select class="form-control" name="client" >
    <option value="">إختر إسم الزبون</option>
    <?php while($row = $stm->fetch()){ ?>
      
      <option value=" <?php echo $row['id'] ?>"> <?php echo $row['company'];?> </option>
     
      <?php 
    
    } ?>  
    </select>
    
  
  </div>

<?php  $stmpr = $db->connect()->prepare("SELECT * FROM product");

        $stmpr->execute(); ?>

<div id="addproduct" class="row" >
<button class="btn btn-danger" type="button"  > حذف </button>

  <div class="form-group col-sm-3 text-right">
      <label >الكمية</label>
      <input id="quant" type="text" name="quantity[]" class="form-control purchdata">
</div>

<div class="form-group col-sm-3 text-right">
      <label >سعر القطعة</label>
      <input id="unitprice" type="text" name="unitprice[]" class="form-control purchdata">
</div>

<div class="form-group text-right">



    <label class="text-right">السلعة</label>
    
    <select class="form-control" name="product[]" style="width:200%;" id="prodsel">
    <option value="">اختار السلعة</option>

    <?php while($row = $stmpr->fetch()){ ?>
      
      <option><?php echo $row['name'];?></option>
      <?php } ?>  
    </select>
    
  </div>


</div>



<div> <button id="anotherproduct" type="button" class="btn btn-primary">إضافة سلعة</button> </div><br><br>
  
<div class="form-group text-right">
      
      <input type="text" name="date" id="datePicker" >
      <label >تاريخ الإصدار</label>
</div>

<div class="col text-center">
  <button type="submit" class="btn btn-success subform">إرسال</button><br><br>
</div>
</form>


</div>


<?php 
include("../template/footer.php"); 
?>
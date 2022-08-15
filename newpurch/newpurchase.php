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
$stm = $db->connect()->prepare("SELECT * FROM vendor");

$stm->execute();

?>

<div class="container invenv" id="newpurchase">
<h5 class="maintext" style="margin-top: 3%;">طلبية شراء</h5>
<a href="mainpurch.php" class="btn btn-outline-primary" >صفحة المشتريات الرئيسية</a><br><br>

<div class="alert alert-danger text-center" id="numbers" role="alert" >
يرجي إدخال أرقام في خانة السعر و الكمية
</div>

<div class="alert alert-danger text-center" id="clientwarn" role="alert" >
يرجي إختيار السلعة
</div>

<div class="alert alert-danger text-center" id="duplicatewarn" role="alert" style="text-align:right;">
تم تكرار سلعة أكثر من مرة
</div>


<form method="post" action="subnewpurch.php" onsubmit=" return newpurchsub()" id="newinvform">

<div class="form-group" >
<div class="text-right">
<label >المورّد</label>
</div>    

    
    <select class="form-control" name="vendorid" onchange="updateProduct(this.value)" >
    <option value="">إسم الشركة</option>
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
    
    <select class="form-control" name="vendor[]" style="width:250px;" id="vendor">
    
    </select>
    
  </div>


</div>



<div class="text-right"> <button id="anotherproduct" type="button" class="btn btn-primary">إضافة سلعة</button> </div><br><br>
  
<div class="form-group text-right">
      
      <input type="text" name="date" id="datePicker" >
      <label >تاريخ الإصدار</label>
</div>

<div class="col text-center">
  <button type="submit" class="btn btn-primary subform">إرسال</button><br><br>
</div>
</form>


</div>


<?php 
include("../template/footer.php"); 
?>
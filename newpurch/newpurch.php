<?php include("../template/header.php"); 
 include_once("../model/db.class.php");
 
 $db = new Database();
 $stm = $db->connect()->prepare("SELECT id,company FROM vendor");
 $stm->execute();


 ?>

<div class="container invenv" style="background-color:#24675c; padding-top:2%; margin-top:3%;">
<h3 style="text-align:center;" id="purh">إضافة مشتريات</h3>
<a class="btn btn-outline-primary" href="mainpurch.php">صفحة المشتريات الرئيسية</a><br><br>
<div class="alert alert-danger" role="alert">
  Please enter a valid number
</div>

<?php 

// session_start();

// if(isset($_SESSION['client'])){

//   $msg = $_SESSION['client'];
//   echo '<div class="alert alert-primary" role="alert">'.$msg.'</div>';

// }

?>


<form method="post" action="subnewpurch.php" id="productForm" onsubmit=" return newpurchsub()">
  
<div class="form-group text-right">
    <label >الشركة</label>

<select class="form-control" name="vendorid" id="products" onchange="getselect(this.value);">
<option value="">إختر المورّد</option>
    <?php while($row = $stm->fetch()) { ?>   
      
      <option value="<?php echo $row['id'] ?>"> <?php echo $row['company']; ?> </option>
      
    <?php } ?>  
</select> 
</div>

 

<div id="addproduct" class="row">

<button class="btn btn-danger" type="button">حذف</button>

<div class="form-group col-sm-3 text-right">
      <label >الكمية</label>
      <input id="quant" type="text" name="quantity[]" class="form-control purchdata">
</div>

<div class="form-group col-sm-3 text-right">
      <label >سعر القطعة</label>
      <input id="unitprice" type="text" name="unitprice[]" class="form-control purchdata">
</div>


<div class="form-group col-sm-3 text-right">
    <label >السلعة</label>

<select class="form-control" name="vendor[]" id="vendor" style="width:170%;">
    
</select> 
</div>




</div>

<div class="moreproduct"></div>

 <div > <button id="anotherproduct" type="button" class="btn btn-primary">إضافة سلعة</button> </div>
<br>

<div class="form-group text-right">
      
      <input type="text" name="date" id="datePicker" >
      <label >التاريخ</label>
      
</div>

<div class="col text-center">
<button  type="submit" class="btn btn-primary  subform">إرسال</button><br><br>
</div>


</form>

</div>

<?php include("../template/footer.php"); ?>
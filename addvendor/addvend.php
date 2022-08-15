<?php 
session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}


include("../template/header.php"); ?>

<div class="container invenv"  style="padding-bottom:8%; background-color: #324851;">
<h3 style="text-align:center; margin-top:3%;">إضافة بيانات مورّد </h3>
<a class="btn btn-outline-primary" href="vendormain.php">صفحة المورّدين</a><br><br>
<?php 

// session_start();

if(isset($_SESSION['vendor'])){

  $msg = $_SESSION['vendor'];
  echo '<div class="alert alert-primary text-center" role="alert" >'.$msg.'</div>';
  unset($_SESSION["vendor"]);

}

?>

<div class="alert alert-danger" role="alert" id="vendordup">
هذه الشركة موجودة بقاعدة البيانات يرجى التحقق عن طريق قائمة المورّدين
</div>

<div class="alert alert-danger" id="companywarn" role="alert" style="text-align:right;">
يرجي كتابة إسم الشركة
</div>

<form method="post" action="vendsubmit.php" id="newvendorform">
  
<div class="form-group text-right">
    <label>إسم الشركة</label>
    <input type="text" class="form-control" name="company" id="company">
  </div>

  <div class="form-group text-right">
    <label>المدير أو موظف المبيعات</label>
    <input type="text" class="form-control" name="manager">
  </div>

  <div class="form-group text-right">
    <label>العنوان</label>
    <input type="text" class="form-control" name="address">
  </div>

  <div class="form-group text-right">
    <label>رقم الهاتف</label>
    <input type="text" class="form-control" name="phone">
  </div>



  <div class="form-group text-right">
    <label >البريد الإلكتروني</label>
    <input type="email" class="form-control" name="email" >
  </div>

  <div class="form-group text-right">
    <label >الموقع الإلكتروني</label>
    <input type="text" class="form-control" name="website" >
  </div>
  
  <button type="button" onclick="newvendsubmit()" class="btn btn-success form-control">إدخال</button><br><br>
</form>

</div>

<?php include("../template/footer.php"); ?>
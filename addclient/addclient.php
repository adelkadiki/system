<?php 

session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}

include("../template/header.php"); ?>

<div class="container" style="background-color:#375e97; color:white; margin-top:3%; border-radius:10px;">
<h3 style="text-align:center;">إضافة بيانات زبون</h3>
<a class="btn btn-outline-primary" href="sales.php">صفحة الزبائن الرئيسية</a><br><br>
<?php 

session_start();

if(isset($_SESSION['client'])){

  $msg = $_SESSION['client'];
  echo '<div class="alert alert-primary" role="alert">'.$msg.'</div>';

}

?>

<div class="alert alert-primary" id="clientconfirm" role="alert">
تم إضافة بيانات زبون جديد
</div>
<div class="alert alert-danger" role="alert">
هذا الزبون موجود بقائمة الزبائن يرجى التحقق من الأسم
</div>

<!-- <form method="post" action="subnew.php"> -->
<form method="POST"  id="newclientform"  action="subnew.php">
  
<div class="form-group text-right">
    <label>الشركة (أو  المحل)</label>
    <input type="text" class="form-control" name="company" id="compname">
  </div>

  <div class="form-group text-right">
    <label>المدير (أو الموظف المسئول)</label>
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
    <label>البريد الإلكتروني</label>
    <input type="email" class="form-control" name="email">
  </div>

  <div class="form-group text-right">
    <label>الموقع الإلكتروني</label>
    <input type="text" class="form-control" name="website">
  </div>
  
  <button type="button" onclick="newclient()"  class="btn btn-primary form-control">إرسال</button><br><br>
</form>
<br><br>
</div>

<?php include("../template/footer.php"); ?>
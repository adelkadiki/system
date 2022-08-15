<?php 
      
      include_once("../model/db.class.php");
      include("../template/header.php");
?>

<div class="container invenv" style="padding-bottom:4%;">
<h3 style="text-align:center; margin-top:3%;" id="testing">إضافة بيانات سلعة</h3>
<a class="btn btn-outline-primary" href="mainproduct.php">صفحة البضائع</a><br><br>
<?php 

$db = new Database();
$stm= $db->connect()->prepare("SELECT id,company FROM vendor");
$stm->execute();

session_start();

if(isset($_SESSION['duplicate'])){

  $msg = $_SESSION['duplicate'];
  echo '<div class="alert alert-warning text-center" role="alert">'.$msg.'</div>';

  unset($_SESSION["duplicate"]);

}

if(isset($_SESSION['product'])){

  $msg = $_SESSION['product'];
  echo '<div class="alert alert-primary text-center" role="alert">'.$msg.'</div>';

  unset($_SESSION["product"]);

}


?>

<div class="alert alert-danger" id="productwarn" role="alert" style="text-align:center;">
يرجي كتابة إسم السلعة
</div>
<div class="alert alert-danger" id="compwarn" role="alert" style="text-align:center;">
يرجي إختيار الشركة المصنعة
</div>

<div class="alert alert-primary" id="addprodsucess" role="alert" style="text-align:center;">
تم إضافة بيانات السلعة الجديدة
</div>


<form method="post" action="prodsubmit.php" id="newprodform" >
  
<div class="form-group text-right">
    <label>إسم السلعة</label>
    <input type="text" class="form-control purchproduct" name="name" id="addprodfield" >
  </div>

  <div class="form-group text-right">
    <label>توصيف السلعة</label>
    <input type="text" class="form-control purchproduct" name="description">
  </div>

  <div class="form-group text-right">
    <label>بلد المنشأ</label>
    <input type="text" class="form-control purchproduct" name="country">
  </div>

  <div class="form-group text-right">
    <label >الشركة المصنعة</label>
    
    <select class="form-control" name="id" id="prodcomp">
    <option value="">إسم الشركة</option>
    
    <?php while($row = $stm->fetch()) { ?>   
      
      <option value="<?php echo $row['id'] ?>"> <?php echo $row['company']; ?> </option>

    <?php } ?>  
    </select>
    
  </div>
  
  <button type="button" onclick="newprodsub()" class="btn btn-success form-control adding">إضـــافة</button><br><br>
</form>

</div>

<script>

 

</script>


<?php include("../template/footer.php"); ?>
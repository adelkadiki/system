<?php


session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}

include_once("../model/db.class.php");
include("../template/header.php");

$id = $_GET['id'];
$url = 'productdetails.php?id='.$id;

$db = new Database();
    
$stm = $db->connect()->prepare("SELECT * FROM product WHERE id=:id");
$stm->bindValue(':id', $id);
$stm->execute();



while($row = $stm->fetch()){




?>

<div class="container" style="padding-top:10%;">
<a href="<?php echo $url ?>" class="btn btn-outline-primary">تفاصيل السلعة</a>
<h3 style="text-align:center;" >تعديل بيانات سلعة</h3>

<form action="subprodupdate.php" method="post">
  <input type="hidden" name="id" value="<?php echo $id ?>">

  <div class="form-group text-right">
    <label >السلعة</label>
    <input type="text" class="form-control" value="<?php echo $row['name']; ?>" name="name">
  </div>
  
  <div class="form-group text-right">
  <label >التوصيف</label>
    <input type="text" class="form-control" value="<?php echo $row['description']; ?>" name="description" >
  </div>

  <div class="form-group text-right">
  <label >المنشأ</label>
    <input type="text" class="form-control" value="<?php echo $row['country']; ?>" name="country" >
  </div>

  <div class="row">
    <div class="col text-center">
  <button type="submit" class="btn btn-success" style="width:100px;">تأكيد</button>
  </div>
  </div>

</form>
<br><br>

<?php }?>

<div class="co text-center" >
<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#myModal">حذف السلعة</button>
</div>



<!-- confirm dialog -->
<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-body">
        <p style="text-align:center;" >هل تريد حذف السلعة ؟</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="productdelete" onclick="productdelete(<?php echo $id ?>)" >إحذف</button>
        <button style="margin-left:65%;" type="button" class="btn btn-primary" data-dismiss="modal">تراجع</button>
      </div>
    </div>
  </div>
</div>
<!-- confirm dialog -->


</div>





<?php  include("../template/footer.php"); ?>
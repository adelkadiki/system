<?php


session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}

include_once("../model/db.class.php");
include("../template/header.php");

$id = $_GET['id'];

//$url = 'vendordetails.php?id='.$id;
$details = 'vendordetails.php?id='.$id;

$db = new Database();
    
$stm = $db->connect()->prepare("SELECT * FROM vendor WHERE id=:id");   
$stm->bindValue(':id', $id);
$stm->execute();   

$url = 'deletevendor.php?id='.$id;

while($row = $stm->fetch()){

?>

<div class="container" style="padding-top: 3%; padding-bottom:4%;">
<a href="<?php echo $details ; ?>" class="btn btn-outline-primary" >بيانات المورّد</a>  
<form action="confupdvendor.php" >

  <input type="hidden" name="id" value="<?php echo $id ?>">

  <div class="form-group text-right">
    <label >الشركة</label>
    <input type="text" class="form-control" value="<?php echo $row['company'] ?>" name="company" >
    
  </div>
  <div class="form-group text-right">
    <label >المدير (الموظف المسئول)</label>
    <input type="text" class="form-control" value="<?php echo $row['manager'] ?>" name="manager" >
  </div>

  <div class="form-group text-right">
    <label >العنوان</label>
    <input type="text" class="form-control" value="<?php echo $row['address'] ?>" name="address">
  </div>
 
  <div class="form-group text-right">
    <label >الهاتف</label>
    <input type="text" class="form-control" value="<?php echo $row['phone'] ?>" name="phone" >
  </div>
 
  <div class="form-group text-right" >
    <label >البريد الإلكتروني</label>
    <input type="text" class="form-control" value="<?php echo $row['email'] ?>" name="email">
  </div>

  <div class="form-group text-right">
    <label >الموقع الإلكتروني</label>
    <input type="text" class="form-control" value="<?php echo $row['website'] ?>" name="website">
  </div>

        <div class="row">
          <div class="col text-center">
  <button type="submit" class="btn btn-success" style="width:120px;">تأكيد</button>
            </div>
            </div>
</form><br><br>

<?php } ?>

   <div class="row">
        <div class="col text-center">
          <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#myModal">حذف</button>
       </div>
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
        <p style="text-align:center;" >
         
هل تريد حذف بيانات المورّد ؟                     </p>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-danger" onclick="vendordelete(<?php echo $id; ?>)">إحذف</button> -->
        <a href="<?php echo $url?>" class="btn btn-danger">إحذف</a>
        <button style="margin-left:65%;" type="button" class="btn btn-primary" data-dismiss="modal">تراجع</button>
      </div>
    </div>
  </div>
</div>
<!-- confirm dialog -->

</div>


<?php include("../template/footer.php"); ?>
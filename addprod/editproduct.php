<?php

session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}

include_once("../model/db.class.php");
include("../template/header.php");

$id = $_GET['id'];
$vendor='';
    $db = new Database();
    
    $stm = $db->connect()->prepare("SELECT * FROM product WHERE id=:id");
    $stm->bindValue(':id', $id);
    $stm->execute();

    while($row = $stm->fetch()){

      $name = $row['name'];
      $description = $row['description'];
      $country = $row['country'];
      $vendor_id = $row['vendor_id'];

      $stmv = $db->connect()->prepare("SELECT company FROM vendor WHERE id=:vendor_id");
      $stmv->bindValue(':vendor_id', $vendor_id);
      $stmv->execute();

      while($vrow = $stmv->fetch()){

        $vendor .= $vrow['company'];
      }


    }
    

?>

<div class="container" style="padding-top: 3%;">

    <h3 style="text-align: center;" >تعديل بيانات سلعة</h3>

<form>
    

  <div class="form-group text-right">
    <label > الإ سم </label>
    <input type="text" class="form-control" value="<?php echo $name ; ?>" >
    
  </div>

  <div class="form-group text-right">
    <label >الوصف</label>
    <input type="text" class="form-control" value="<?php echo $description; ?>" >
  </div>

  <div class="form-group text-right">
    <label >المنشأ</label>
    <input type="text" class="form-control" value="<?php echo $country; ?>" >
  </div>

  <div class="form-group text-right">
    <label ></label>
    <span><?php echo $vendor; ?> الشركة المصنعة </span>
  </div><br>

  <div class="row">
    <div class="col text-center">
<button type="submit" class="btn btn-primary">Submit</button>
</div>
</div>

</form>

</div>



<?php include("../template/footer.php"); ?>
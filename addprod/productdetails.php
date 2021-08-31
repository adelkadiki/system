<?php


session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}

include_once("../model/db.class.php");
include("../template/header.php");

$id = $_GET['id'];
$vendor ='';

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

    while($rowv = $stmv->fetch()){

        $vendor = $rowv['company'];
    }
        

}

$url = 'productupdate.php?id='.$id;

?>

<div class="container" style="padding-top: 3%;">
<a href="productslist.php" > <button  style="margin-bottom:30px;" class="btn btn-outline-primary">صفحة البضائع</button></a>
<h5 style="text-align:center; "><span><?php echo $id; ?></span> رمز المنتج</h5><br>

<table class="table">
    
<thead class="thead-dark">
  
    <tr>
      
      <th scope="col">الوصف</th>
      <th scope="col">السلعة</th>
      

    </tr>
  
  </thead>
  <tbody>
    
    <tr>
     
      <td> <?php echo $description; ?> </td>
      <td> <?php echo $name; ?> </td>
      
    </tr>
    
  </tbody>

  <thead class="thead-dark">

  <th scope="col">الشركة المصنعة</th>
  <th scope="col">المنشأ</th>
  
  </thead>
  <tbody>
  <td> <?php echo $vendor; ?> </td>
  <td> <?php echo $country; ?> </td>
  
  </tbody>


</table>
<br>

<div class="col text-center">
<a href="<?php echo $url; ?>" class="btn btn-primary" style="width:120px;">تعديل</a>
</div>


</div>




<?php  include("../template/footer.php"); ?>
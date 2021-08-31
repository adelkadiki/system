<?php

session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}

include_once("../model/db.class.php");
require("../template/header.php");

$id = $_GET['id'];

$url = 'updatevendor.php?id='.$id;

$db = new Database();
    
$stm = $db->connect()->prepare("SELECT * FROM vendor WHERE id=:id");   
$stm->bindValue(':id', $id);
$stm->execute();   

while($row = $stm->fetch()){

    $id = $row['id'];
    $company = $row['company'];
    $manager = $row['manager'];
    $phone = $row['phone'];
    $email = $row['email'];
    $address = $row['address'];
    $website = $row['website'];

}

?>

<div class="container" style="padding-top:3%;">
<a href="allvendors.php" class="btn btn-outline-primary" >قائمة المورّدين</a>  
<h4 style="text-align:center; margin-bottom:40px;">تفاصيل بيانات المورّد</h4>

<table class="table">
  <thead class="thead-dark">
    <tr>
      
      <th scope="col">الهاتف</th>
      <th scope="col">الموظف</th>
      <th scope="col">الشركة</th>
      
    </tr>
  </thead>
  <tbody>
   
    <tr>
      
      <td> <?php echo $phone ?> </td>
      <td><?php echo $manager ?></td>
      <td><?php echo $company ?></td>
      
    </tr>
   
    
  </tbody>
</table>

<table class="table">
  <thead class="thead-dark">
    
    <tr>
      
      <th scope="col">البريد الإلكتروني</th>
      <th scope="col">العنوان</th>
      <th scope="col">الموقع الإلكتروني</th>

    </tr>

  </thead>
  <tbody>
  
    <tr>
      <td> <?php echo $email ?> </td>
      <td><?php echo $address ?></td>
      <td><?php echo $website ?></td>
      
    </tr>
    
  </tbody>

</table><br><br><br>

<div class="row">
<div class="col text-center">
<a href="<?php echo $url; ?>" class="btn btn-warning">تعديل</a>
</div>
</div>

</div>

<?php require("../template/footer.php"); ?>
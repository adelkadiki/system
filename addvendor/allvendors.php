<?php

session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}
include_once("../model/db.class.php");
require("../template/header.php");

$db = new Database();
    
$stm = $db->connect()->prepare("SELECT * FROM vendor");   
$stm->execute();   

?>

<div class="container" style="padding-top:3%;">

<h4 style="text-align:center; margin-bottom:40px;">قائمة المورّدين</h4>

<table class="table table-striped" id="vendorstable">
  <thead>
    <tr>
      
      <th scope="col">الشركة</th>
      <th scope="col">الموظف</th>
      <th scope="col">الهاتف</th>
      <th></th>
      
    </tr>
  </thead>
  <tbody>
    <?php while($row = $stm->fetch()) {

            $id = $row['id'];
            $url = 'vendordetails.php?id='.$id;
      ?>
              
    <tr>
      <td><?php echo $row['company']; ?></td>
      <td><?php echo $row['manager']; ?></td>
      <td><?php echo $row['phone']; ?></td>
      <td> <a class="btn btn-outline-info" href="<?php echo $url; ?>">التفاصيل</a> </td>
    </tr>
    <?php }?>
  </tbody>
</table>

</div>


<?php require("../template/footer.php"); ?>
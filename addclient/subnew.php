<?php 

include_once("../model/db.class.php");
include("../template/header.php");

if($_SERVER['REQUEST_METHOD']=='POST'){

    $company = $_POST['company'];
    $manager = $_POST['manager'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $website = $_POST['website'];


$db = new Database();
$stm = $db->connect()->prepare("INSERT INTO client(company, manager, address, phone, email, website) 
VALUES(:company, :manager, :address, :phone, :email, :website)");
$stm->bindValue(':company', $company);
$stm->bindValue(':manager', $manager);
$stm->bindValue(':address', $address);
$stm->bindValue(':phone', $phone);
$stm->bindValue(':email', $email);
$stm->bindValue(':website', $website);
$stm->execute();

}

?>

<div class="container">

<h5 style="text-align:center; margin-top:3%;"> بيانات <span><?php echo $company ?></span>  </h5>

<table class="table">
  <thead class="thead-dark">
    <tr>
      
      <th scope="col">Company</th>
      <th scope="col">Manager</th>
      <th scope="col">Address</th>
      
    </tr>
  </thead>
  <tbody>
    <tr>
      
      <td><?php echo $company; ?></td>
      <td><?php echo $manager; ?></td>
      <td><?php echo $address; ?></td>

    </tr>
   
  </tbody>
</table>

<table class="table">
  <thead class="thead-dark">
    <tr>
      
      <th scope="col">Phone</th>
      <th scope="col">Email</th>
      <th scope="col">Website</th>
      
    </tr>
  </thead>
  <tbody>
    <tr>
      
      <td><?php echo $phone; ?></td>
      <td><?php echo $email; ?></td>
      <td><?php echo $website; ?></td>

    </tr>
   
  </tbody>
</table>

<?php 
$id=0;
 $stmc = $db->connect()->prepare("SELECT id FROM client ORDER BY id DESC LIMIT 1");
 $stmc->execute();
 

 while($row = $stmc->fetch()) {

       $id = $row['id'];
 }

    $url = 'deleteclt.php?id='.$id;
    $invoiceurl = 'newinvoice.php?id='.$id.'&company='.$company ;
?>



<div class="col text-center">

<a href="sales.php" class="btn btn-primary"  >تأكيد البيانات و عودة للصفحة الرئيسية</a><br><br>
<a href="<?php echo $invoiceurl ?>" class="btn btn-success" >تأكيد البيانات وإصدار فاتورة</a><br><br>
<a href="<?php echo $url?>" class="btn btn-danger" style="width:120px;">إلغاء</a>
</div>

</div>

<?php include("../template/footer.php");?>
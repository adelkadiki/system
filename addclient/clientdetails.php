<?php

session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}

include("../template/header.php"); 
require_once("../model/db.class.php");
require_once("../model/client.class.php");



    $id = $_GET['id'];

    $updateUrl = 'updateclient.php?id='.$id;

    $db = new Database();
    $stm = $db->connect()->prepare("SELECT * FROM client WHERE id=:id");
    $stm->bindValue(':id', $id);
    $stm->execute();
    

    while($row = $stm->fetch()){

      $company = $row['company'];
      $manager = $row['manager'];
      $address = $row['address'];
      $phone = $row['phone'];
      $email = $row['email'];
      $website = $row['website'];
    
    }
?>


<div class="container" style="padding-top: 3%;">

<div style="" id="clientid"></div>

<a href="allclients.php" class="btn btn-outline-primary">قائمة الزبائن</a>

<table class="table" style="margin-top:7%;">
  <thead class="thead-dark">
    <tr>
     
      <th scope="col">الشركة</th>
      <th scope="col">الإدارة</th>
      <th scope="col">الهاتف</th>
    </tr>
  </thead>
  <tbody>
  
    <tr>
   

      <td > <?php echo $company;?> </td>
      <td> <?php echo $manager;?> </td>
      <td> <?php echo $phone;?> </td>
     
   
    </tr>
  
        

  </tbody>
</table>

<table class="table" >
  <thead class="thead-dark">
    <tr>
     
      <th scope="col">البريد الإلكتروني</th>
      <th scope="col">العنـــوان</th>
      <th scope="col">الموقع الإلكتروني</th>
    </tr>
  </thead>
  <tbody>
  
    <tr>
    

      <td > <?php echo $email;?> </td>
      <td> <?php echo $address;?> </td>
      <td> <?php echo $website;?> </td>
     
    
    </tr>
  
        

  </tbody>
</table><br><br><br>

<div class="row">
        <div class="col text-center">
<a href="<?php echo $updateUrl; ?>" class="btn btn-warning">تعديل</a>
        </div>
 </div>       

</div>

<!-- <form action="updateclient.php" method="get">

<input type="text" name="id" value="<?php echo $id ?>">

<button class="btn btn-primary">Edit</button>

</form>


<form action="deleteclt.php" method="get" id="clientdelform">

<input type="text" name="id" value="<?php echo $id; ?>">

<button>sub</button>

</form> -->


<!-- <div class="btn btn-danger" id="delwarn">Delete</div> -->

<?php 
    


include("../template/footer.php"); 
?>



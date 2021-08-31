<?php

include("../template/header.php"); 
require_once("../model/db.class.php");
require_once("../model/client.class.php");

if($_SERVER['REQUEST_METHOD']=='GET'){

    $id= $_GET['id'];
    $db = new Database();
   $stm =  $db->connect()->prepare("SELECT * FROM client WHERE id= :id");
   $stm->bindValue(':id', $id);
   $stm->execute();

   while($row = $stm->fetch() ){  ?>

<div class="container">

<a class="btn btn-primary" href="allclients.php" style="margin-top:3%;">Clients list</a><br><br>

<form action="clienteditsubmit.php" method="POST">

    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

  <div class="form-group">
  <div class="col-md-12">
    <label for="company">Company</label>
    <input type="text" class="form-control" id="company" 
    value="<?php echo $row['company'] ?>" name="company">
   </div>
  </div>

  <div class="form-group">
  <div class="col-md-12">
    <label for="manager">Manager</label>
    <input type="text" class="form-control" id="manager" 
    value="<?php echo $row['manager']; ?>" name="manager">
  </div>
  </div>

  <div class="form-group">
  <div class="col-md-12">
    <label for="address">Address</label>
    <input type="text" class="form-control" id="address" 
    value="<?php echo $row['address']; ?>" name="address">
   </div>
  </div>
 
  <div class="form-group">
  <div class="col-md-12">
    <label for="company">Phone</label>
    <input type="text" class="form-control" id="phone" 
    value="<?php echo $row['phone']; ?>" name="phone">
   </div>
  </div>

  <div class="form-group">
  <div class="col-md-12">
    <label for="email">Email</label>
    <input type="text" class="form-control" id="email" 
    value="<?php echo $row['email']; ?>" name="email">
   </div>
  </div>

  <div class="form-group">
  <div class="col-md-12">
    <label for="website">Website</label>
    <input type="text" class="form-control" id="website" 
    value="<?php echo $row['website']; ?>" name="website">
   </div>
  </div>

  <button type="submit" class="btn btn-primary" style="margin-bottom:4%;">Submit</button>
</form>
    </div>
  <?php  } ?>


<?php } 

include("../template/footer.php"); 

?>

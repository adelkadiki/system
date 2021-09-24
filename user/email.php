<?php


session_start();
if(!isset($_SESSION['user_id'])){
   header("location: ../index.php");
}

include_once("../model/db.class.php");
include("../template/header.php"); 

$userid = $_SESSION['user_id'];

?>

<div class="container" style="padding-top:3%;">

<form action="emailreset.php">
  
  <div class="form-group">
    <label >Email address</label>
    <input type="hidden" name="userid" value="<?php echo $userid ?>">
    <input type="email" class="form-control" name="email">
    
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>


<?php include("../template/footer.php"); ?>

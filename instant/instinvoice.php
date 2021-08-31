<?php 
include("../template/header.php"); 
require_once("../model/db.class.php");




?>

<div class="container">
<h5 class="maintext" style="margin-top:3%;">New Invoice</h5>
<a href="salesmain.php" class="btn btn-primary" >Sales Main</a><br><br>

<div class="alert alert-danger" role="alert">
  Please enter a valid number
</div>
<form method="post" action="subinsinv.php" onsubmit=" return newpurchsub()">

<div class="form-group">

    <label>Client</label>
    
    <input type="text" class="form-control" name="client">
  
  </div>


<div id="addproduct" class="row" >
<div class="form-group">
    <label for="exampleFormControlSelect1">Product</label>
    
    <input type="text" name="product[]" class="form-control">
  </div>

  <div class="form-group col-sm-3">
      <label >Quqntity</label>
      <input id="quant" type="text" name="quantity[]" class="form-control purchdata">
</div>

<div class="form-group col-sm-3">
      <label >Price per unit</label>
      <input id="unitprice" type="text" name="unitprice[]" class="form-control purchdata">
</div>
<button class="btn btn-danger" type="button"  >Remove</button>
</div>



<div> <button id="anotherproduct" type="button" class="btn btn-primary">Add Product</button> </div><br><br>
  
<div class="form-group row">
      <div class="col-xs-2">
      <label >Date</label>
      <input type="text" name="date" id="datePicker" class="form-control">
      </div>
</div>

<div class="col text-center">
  <button type="submit" class="btn btn-success subform">Submit</button><br><br>
</div>
</form>


</div>


<?php 
include("../template/footer.php"); 
?>
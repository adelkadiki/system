<?php

// include_once("model/db.class.php");
// include("template/header.php"); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../template/css.css" media="all"  type="text/css"/> -->
    <title>System</title>
    <link rel="shortcut icon" href="">

    <link rel="stylesheet" href="../template/css.css?v=<?php echo time(); ?>" media="all">
    <link rel="stylesheet" type="text/css" media="print" href="../template/print.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>

<body>


<div class="container" style="padding-top:20%">

<div class="alert alert-danger" role="alert" id="emailresetalert">
  The email address is not found
</div>

<form>
  <div class="form-group" >
    <label>Email address</label>
    <input type="email" id="emailreset" class="form-control" placeholder="Enter email">
    
  </div>
  
  <div class="container">
  <div class="row">
    <div class="col text-center">
      <button class="btn btn-success" type="button" onclick="resetpass()">Submit</button>
    </div>
  </div>
</div>
  
</form>

</div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script> 
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
   
  
   <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
   <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
   
   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
   <script type="text/javascript" src='../template/file.js' ></script>


</body>
</html>



<?php 
 //include("template/footer.php"); 
?>
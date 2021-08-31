
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

<div class="container" style="padding-top:10%; padding-left:25%;">

<?php 

session_start();

if(isset($_SESSION['error'])) {

    $error = $_SESSION['error'];

?>

<div style="color:red;"><?php echo $error ?></div>

<?php }?>

<form method="post" action="authen.php">

<div class="form-group row">    

<div class="col-xs-4">
<label >Username</label>
<input type="text" name="username" class="form-control logininput">
</div>

</div>

<div class="form-group row">
<div class="col-xs-4">
<label>Password</label>
<input type="password" name="password" class="form-control logininput">
</div>

</div>


<button type="submit" name="login" class="btn btn-primary">Login</button>
</form>
<a href="reset.php">Forget password</a>
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




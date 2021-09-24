<?php

session_start();

if(isset($_SESSION['attempt'])){

    unset($_SESSION['attempt']);
}

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

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css"/>
   
   
</head>

<body>


<div class="container" style="padding-top:10%;">

<div class="alert alert-danger" id="emailwarn" role="alert">
الرجاء كتابة البريد الإلكتروني
</div>
<div class="alert alert-danger" id="emailvalid" role="alert">
الرجاء كتابة بريد إلكتروني صحيح
</div>
<div class="alert alert-danger" id="emailnotfound" role="alert">
لم يتم العثور على هذا البريد الإلكتروني 
</div>


<form action="emailpass.php" id="emailresetform">
  
  <div class="form-group">
    
    <label >البريد الإلكتروني</label>
    <input type="text" name="email" class="form-control" id="emailadd" style="direction: ltr;">
    
  </div>
  
  <button type="button" onclick="emailsend()" class="btn btn-primary">إرسل</button>
</form>

</div>


<?php include("template/footer.php"); ?>
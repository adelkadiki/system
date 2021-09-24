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



<div class="container" style="padding-top:10%; ">

<div id="usernamewarn" class="alert alert-danger" style="text-align:center;" role="alert">
يرجي كتابة إسم المستخدم و كلمة السر
</div>


<div id="loginuserpass" class="alert alert-danger" style="text-align:center;" role="alert">
username or password 
</div>


<?php 


if(isset($_COOKIE['error'])) {

//$count = $_COOKIE['attempt'];
// echo ' cookie value = '.$count;

  //      if($count > 2) {
  //           header("Location: passreset.php") ;
  //      }
        $msg = $_COOKIE['error'];

        echo '<div class="alert alert-danger" style="text-align:center;" role="alert" id="unvalid" >'.$msg.'</div>';
        setcookie("error", "", time()-3600);

    }

// else {
//     $_SESSION['attempt']=0 ;
// } 
   


// if(isset($_SESSION['error'])) {

//     $error = $_SESSION['error'];
    
//     echo ' <div class="alert alert-danger" style="text-align:center;" role="alert" id="unvalid" > '.$error.' </div>';

//  }

// unset($_SESSION['error']);

?>


<form method="post" id="loginform" action="authen.php">

<div class="form-group row">    


<div class="col-xs-4">
<div class="form-group text-right">
<label >اسم المستخدم</label>
<input type="text" name="username" id="loguser" class="form-control logininput">
</div>
</div>
</div>

<div class="form-group row">
<div class="col-xs-4">
<div class="form-group text-right">
<label>كلمه السر </label>
<input type="password" name="password" id="logpass" class="form-control logininput">
</div>
</div>

</div>

<!-- button =  loginfun() onclick -->
<button type="button" onclick="loginvalidate()" name="login" class="btn btn-primary" style="margin-left:10%;" >تسجيل الدخول</button>

</form><br>
<a href="passreset.php" style="margin-left:40%;">نسيت كلمة المرور </a>

    
</div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script> 
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
   
  
   <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
   <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
   
   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
   <!-- <script type="text/javascript" src='../template/file.js' ></script> -->

<script>

$count = 0;
function loginvalidate(){
    
    $count +=1;
    $('#usernamewarn').hide();
    $('#unvalid').hide();
    $username = $('#loguser').val();
    $password = $('#logpass').val();
    

    if($count == 3){
    
        window.location = 'passreset.php';
    
    }else if($username == "" || $password == ""){
    
            $('#usernamewarn').show();
           // $count +=1;
    
        }else {

            $('#loginform').submit();
            $('#unvalid').show();
            
        }
            // $count +=1;
            // console.log($count);
          
    }


</script>
</body>
</html>




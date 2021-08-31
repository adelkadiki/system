<?php 

require_once("model/db.class.php");
include("template/header.php");


$selector = $_GET['selector'];
$validator = $_GET['validator'];

if(empty($selector) || empty($validator)){

    echo "<h3> Could not validate your request </h3>";

} else {

     if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){

        ?>
    
    <form action="subnewpassword.php" method="post">
    
    <input type="hidden" name="selector" value="<?php echo $selector?>">
    <input type="hidden" name="validator" value="<?php echo $validator?>">
    <input type="text" id="passwordone" name="password" placeholder="Enter a new password">
    <input type="text"  id="passwordtwo" placeholder="Retype your new password">

        <button type="submit">Submit</button>
    </form>

        <?php

     }
     

}

?>
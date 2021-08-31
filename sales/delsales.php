<?php 

include_once("../model/db.class.php");

if($_SERVER['REQUEST_METHOD']=='GET'){

    session_start();
    $page = $_SESSION['page'];
    unset($_SESSION["page"]);

    $id= $_GET['id'];

    $db = new Database();
    
    $stm = $db->connect()->prepare("DELETE FROM sales WHERE id=:id");    
    $stm->bindValue(':id', $id);
    $stm->execute();

    if($page == 'invoice.php'){
     
        header("Location: salesmain.php"); 
    
    } else if($page == 'newinvoice.php'){

        header("Location: ../addclient/sales.php"); 
    }

    
}

?>
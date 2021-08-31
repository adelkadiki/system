<?php 

include_once("../model/db.class.php");

if($_SERVER['REQUEST_METHOD']=='POST'){


    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];

    $db = new Database();

    $stm = $db->connect()->prepare("SELECT SUM(payment) as sum_pay FROM sales WHERE date >=:fromdate  AND date <=:todate");   
    $stm->bindValue(':fromdate', $fromdate);
    $stm->bindValue(':todate', $todate);
    $stm->execute();

    

    $row = $stm->fetch(PDO::FETCH_ASSOC);
    $sum = $row['sum_pay'];

    // echo $sum;

    $stmpr = $db->connect()->prepare("SELECT SUM(totalprice) as sum_pay FROM purchasement WHERE date >=:fromdate  AND date <=:todate");   
    $stmpr->bindValue(':fromdate', $fromdate);
    $stmpr->bindValue(':todate', $todate);
    $stmpr->execute();

    

    $rowpr = $stmpr->fetch(PDO::FETCH_ASSOC);
    $sumpr = $rowpr['sum_pay'];

    echo '<div style="text-align:center; font-size: 25px; font-family:Arial;" dir="rtl"> اجمالي المشتريات  = '.$sumpr.'</div>';
    echo '<div style="text-align:center; font-size: 25px; font-family:Arial;" dir="rtl"> اجمالي المبيعات  = '.$sum.'</div>';
  }

?>
<?php 

include("../model/db.class.php");

if($_SERVER['REQUEST_METHOD']=='POST'){

    $year = $_POST['year'];
     $fromdate = $year.'-01-01';
     $todate = $year.'-01-31';
     $result=array();
    $total=0;       

$db = new Database();

$stm = $db->connect()->prepare("SELECT SUM(payment) AS totpmn FROM sales WHERE date >=:fromdate AND date <=:todate");

$stm->bindValue(':fromdate', $fromdate);
$stm->bindValue(':todate', $todate);
$stm->execute();

      
     
          $row = $stm->fetch(PDO::FETCH_ASSOC);

            $total = $row['totpmn'];
            array_push($result, $total);

        

      // February

      $feb = (date('L', mktime(0, 0, 0, 1, 1, $year)) ? '29' : '28' );

      $fromdate = $year.'-02-01';
      $todate = $year.'-02-'.$feb;
      
$stm = $db->connect()->prepare("SELECT SUM(payment) AS totpmn FROM sales WHERE date >=:fromdate AND date <=:todate");

$stm->bindValue(':fromdate', $fromdate);
$stm->bindValue(':todate', $todate);
$stm->execute();

    
          $row = $stm->fetch(PDO::FETCH_ASSOC);

            $total = $row['totpmn'];
            array_push($result, $total);

            
  // March
  
  $fromdate = $year.'-03-01';
  $todate = $year.'-03-31';
      
$stm = $db->connect()->prepare("SELECT SUM(payment) AS totpmn FROM sales WHERE date >=:fromdate AND date <=:todate");

$stm->bindValue(':fromdate', $fromdate);
$stm->bindValue(':todate', $todate);
$stm->execute();

    
          $row = $stm->fetch(PDO::FETCH_ASSOC);

            $total = $row['totpmn'];
            array_push($result, $total);
                      
            
// April

$fromdate = $year.'-04-01';
$todate = $year.'-04-30';
    
$stm = $db->connect()->prepare("SELECT SUM(payment) AS totpmn FROM sales WHERE date >=:fromdate AND date <=:todate");

$stm->bindValue(':fromdate', $fromdate);
$stm->bindValue(':todate', $todate);
$stm->execute();

  
        $row = $stm->fetch(PDO::FETCH_ASSOC);

          $total = $row['totpmn'];
          array_push($result, $total);


// May 

$fromdate = $year.'-05-01';
$todate = $year.'-05-31';
    
$stm = $db->connect()->prepare("SELECT SUM(payment) AS totpmn FROM sales WHERE date >=:fromdate AND date <=:todate");

$stm->bindValue(':fromdate', $fromdate);
$stm->bindValue(':todate', $todate);
$stm->execute();

  
        $row = $stm->fetch(PDO::FETCH_ASSOC);

          $total = $row['totpmn'];
          array_push($result, $total);

// June

$fromdate = $year.'-06-01';
$todate = $year.'-06-30';
    
$stm = $db->connect()->prepare("SELECT SUM(payment) AS totpmn FROM sales WHERE date >=:fromdate AND date <=:todate");

$stm->bindValue(':fromdate', $fromdate);
$stm->bindValue(':todate', $todate);
$stm->execute();

  
        $row = $stm->fetch(PDO::FETCH_ASSOC);

          $total = $row['totpmn'];
          array_push($result, $total);

// July

$fromdate = $year.'-07-01';
$todate = $year.'-07-31';
    
$stm = $db->connect()->prepare("SELECT SUM(payment) AS totpmn FROM sales WHERE date >=:fromdate AND date <=:todate");

$stm->bindValue(':fromdate', $fromdate);
$stm->bindValue(':todate', $todate);
$stm->execute();

  
        $row = $stm->fetch(PDO::FETCH_ASSOC);

          $total = $row['totpmn'];
          array_push($result, $total);
          
// August

$fromdate = $year.'-08-01';
$todate = $year.'-08-31';
    
$stm = $db->connect()->prepare("SELECT SUM(payment) AS totpmn FROM sales WHERE date >=:fromdate AND date <=:todate");

$stm->bindValue(':fromdate', $fromdate);
$stm->bindValue(':todate', $todate);
$stm->execute();

  
        $row = $stm->fetch(PDO::FETCH_ASSOC);

          $total = $row['totpmn'];
          array_push($result, $total);

 // September
 
 $fromdate = $year.'-09-01';
 $todate = $year.'-09-30';
    
$stm = $db->connect()->prepare("SELECT SUM(payment) AS totpmn FROM sales WHERE date >=:fromdate AND date <=:todate");

$stm->bindValue(':fromdate', $fromdate);
$stm->bindValue(':todate', $todate);
$stm->execute();

  
        $row = $stm->fetch(PDO::FETCH_ASSOC);

          $total = $row['totpmn'];
          array_push($result, $total);


// October

$fromdate = $year.'-10-01';
$todate = $year.'-10-31';
    
$stm = $db->connect()->prepare("SELECT SUM(payment) AS totpmn FROM sales WHERE date >=:fromdate AND date <=:todate");

$stm->bindValue(':fromdate', $fromdate);
$stm->bindValue(':todate', $todate);
$stm->execute();

  
        $row = $stm->fetch(PDO::FETCH_ASSOC);

          $total = $row['totpmn'];
          array_push($result, $total);

 // November
 
 $fromdate = $year.'-11-01';
$todate = $year.'-11-30';
    
$stm = $db->connect()->prepare("SELECT SUM(payment) AS totpmn FROM sales WHERE date >=:fromdate AND date <=:todate");

$stm->bindValue(':fromdate', $fromdate);
$stm->bindValue(':todate', $todate);
$stm->execute();

  
        $row = $stm->fetch(PDO::FETCH_ASSOC);

          $total = $row['totpmn'];
          array_push($result, $total);

// December

$fromdate = $year.'-12-01';
$todate = $year.'-12-31';
    
$stm = $db->connect()->prepare("SELECT SUM(payment) AS totpmn FROM sales WHERE date >=:fromdate AND date <=:todate");

$stm->bindValue(':fromdate', $fromdate);
$stm->bindValue(':todate', $todate);
$stm->execute();

  
        $row = $stm->fetch(PDO::FETCH_ASSOC);

          $total = $row['totpmn'];
          array_push($result, $total);

           echo json_encode($result);

                     
        
}

?>
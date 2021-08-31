<?php
include_once("../model/db.class.php");
include("../template/header.php");


if($_SERVER['REQUEST_METHOD']=='POST'){

  $client= $_POST['client'];
  $quantity = $_POST['quantity'];
  $unitprice = $_POST['unitprice'];
  $product = $_POST['product'];
  $date = $_POST['date'];
  $client_id=4;

  echo $client.'<br>';
  echo $quantity.'<br>';
  echo $unitprice.'<br>';
  echo $product.'<br>';
  echo $date.'<br>';

  $db = new Database();
    
  $stm = $db->connect()->prepare("INSERT INTO sales(client, payment, date, client_id) 
  VALUES(:client, :payment, :date, :client_id)");   

  $stm->bindValue(':client', $client);
  $stm->bindValue(':payment', $total);
  $stm->bindValue(':date', $date);
  $stm->bindValue(':client_id', $client_id);
  $stm->execute();   

}
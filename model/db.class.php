<?php


class Database {

    private $host = "localhost";
    private $username = "adel";
   //private $username = "alertika_adel";
   private $password = "adel";
   // private $password = "KkPqhLgb4nar85g";
   // private $db = "alertika_system";
   private $db = "british";
    private $port = '3306';

      public function connect(){

        try{

        $dbc = 'mysql:host='.$this->host.';port='.$this->port.';dbname='.$this->db;
        $pdo = new PDO($dbc, $this->username, $this->password);
        
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
      }catch(PDOException $e){
          echo $e->getMessage();
        }


        return $pdo;

    }

   
    



}

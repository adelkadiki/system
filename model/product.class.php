<?php 

include_once("db.class.php");

class Product {


    public  function add($name, $description, $country, $vendor_id)
    {

        $db = new Database();

        try{
            
        $stm = $db->connect()->prepare("INSERT INTO product(name, description, country, vendor_id) 
        VALUES(:name, :description, :country, :vendor_id)");

        $stm->bindValue(':name', $name);
        $stm->bindValue(':description', $description);
        $stm->bindValue(':country', $country);
        $stm->bindValue(':vendor_id', $vendor_id);

        $stm->execute();
        
        }catch(PDOException $e){

        echo $e->getMessage();
    }


    }


}

?>
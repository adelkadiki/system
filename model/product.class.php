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


    public function updateProductQuantity($product, $addedQuantity)
    {

        $db = new Database();
        $newQnt=0;

        try{

        $stm = $db->connect()->prepare("SELECT quantity FROM product WHERE name=:product");
        $stm->bindValue(':product', $product);
        $stm->execute();

        while($row = $stm->fetch()){

            $newQnt = $row['quantity'] + $addedQuantity;
        }

            $stm2 = $db->connect()->prepare("UPDATE product SET quantity=:quantity WHERE 
            name=:product");
            $stm2->bindValue(':product', $product);
            $stm2->bindValue(':quantity', $newQnt);
            $stm2->execute();
        

                }catch(PDOException $e){

                    echo $e->getMessage();
                }

    }


    public function checkDuplicate($name){

        $result = false;
        $db = new Database();

        try{
            
            $stm = $db->connect()->prepare("SELECT * FROM product WHERE name=:name");
            $stm->bindValue(':name', $name);
            $stm->execute();

            if($row = $stm->fetch()){

                    if(!empty($row['name'])){
                            $result = true;
                    }
            }
            
            }catch(PDOException $e){
    
            echo $e->getMessage();
        }

        return $result;

    }


}

?>
<?php 

require_once("db.class.php");

class Vendor {


    public function add($company, $manager, $address, $phone, $email, $website){

            $db = new Database();

            try{

                    $stm = $db->connect()->prepare("INSERT INTO vendor(company, manager, address, phone, email,
                    website) VALUES(:company, :manager, :address, :phone, :email, :website)");

                    $stm->bindValue(':company', $company);
                    $stm->bindValue(':manager', $manager);
                    $stm->bindValue(':address', $address);
                    $stm->bindValue(':phone', $phone);
                    $stm->bindValue(':email', $email);
                    $stm->bindValue(':website', $website);

                    $stm->execute();

                }catch(PDOException $e){
               echo $e->getMessage();
    }

    }

}


?>
<?php 

require_once("db.class.php");

class Client {


    public function add($company, $manager, $address, $phone, $email, $website){

            $db = new Database();

            try{

                    $stm = $db->connect()->prepare("INSERT INTO client(company, manager, address, phone, email,
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

    public function update($id, $company, $manager, $address, $email, $website, $phone){

        $db = new Database();

        try{

            $stm = $db->connect()->prepare("UPDATE client SET company=:company, 
            manager=:manager, address=:address, email=:email, website=:website,
            phone=:phone WHERE id=:id");
            $stm->bindValue(':id', $id);
            $stm->bindValue(':company', $company);
            $stm->bindValue(':manager', $manager);
            $stm->bindValue(':address', $address);
            $stm->bindValue(':email', $email);
            $stm->bindValue(':website', $website);
            $stm->bindValue(':phone', $phone);
            $stm->execute();

        }catch(PDOException $e){

            echo $e->getMessage();
        }
    }

}


?>
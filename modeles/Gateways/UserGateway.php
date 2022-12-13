<?php

class UserGateway {
    private $co;

    function __construct(Connection $co) { 
        $this->co = $co; 
    } 

    function getUtilisateurNom(string $usr){
        $co=$this->co;
        $query="SELECT nom FROM Utilisateur WHERE nom=:nom";
        $co->executeQuery($query,array('nom'=>array($usr,PDO::PARAM_STR)));
        return $co->getResults();

    }

    function getHashedPassword(string $usrname):?string{
        $hashedPwd=null;
        $co=$this->co;
        $query="SELECT pwd FROM Utilisateur WHERE nom=:nom";
        $co->executeQuery($query,array('nom'=>array($usrname,PDO::PARAM_STR)));
        $res=$co->getResults();
        foreach($res as $row){
            $hashedPwd=$row['pwd'];
        }
        return $hashedPwd;
    }

    function creerUtilisateur(string $nom, string $pwd){
        try{
            $co = $this->co;

            $query = "INSERT INTO Utilisateur VALUES (:nom, :pwd)";

            $co->executeQuery($query, array(':nom' => array($nom, PDO::PARAM_STR), ':pwd' => array($pwd, PDO::PARAM_STR)));
        }
        catch(PDOException $Exception){
            echo 'erreur';
            echo $Exception->getMessage();
            return false;
        }

        return true;
    }

    function delUtilisateur(int $id){
        if(!empty($id)){
            try{
                $co = $this->co;

                $query = "DELETE FROM Utilisateur WHERE id=:id";

                $co->executeQuery($query, array(':id' => array($id, PDO::PARAM_STR)));
            }
            catch(PDOException $Exception){
                echo 'erreur';
                echo $Exception->getMessage();
            }
        }
    }

    function putUtilisateur(Utilisateur $usr){
        if(!empty($usr.getId()) && !empty($usr.getNom()) && empty($usr.getPassword())){
            try{
                $co = $this->co;

                $updateQuery = "UPDATE Utilisateur SET id=:id AND nom=:nom AND pwd=:pwd";
                $deleteQuery = "DELETE FROM HasList WHERE user=:id AND liste=:liste";
                $insertQuery = "INSERT INTO HasList VALUES (:id, :liste)";

                $co->executeQuery($updateQuery, array(':id' => array($usr.getId(), PDO::PARAM_STR), ':nom' => array($usr.getNom(), PDO::PARAM_STR), ':pwd' => array($usr.getPassword(), PDO::PARAM_STR)));            
                foreach($usr.getListListe() as $l){
                    $co->executeQuery($deleteQuery, array(':id' => array($usr.getId(), PDO::PARAM_STR), ':liste' => array($l, PDO::PARAM_STR)));
                    $co->executeQuery($insertQuery, array(':id' => array($usr.getId(), PDO::PARAM_STR), ':liste' => array($l, PDO::PARAM_STR)));
                }
                
            }

            catch(PDOException $Excception){
                echo 'erreur';
                echo $Excception->getMesage();
            }
        }
    }

    function getUtilisateurById(int $id) : Utilisateur {
        $usr = null;
        if(!empty($id)){
            try{
                $co = $this->co;

                $query = "SELECT * FROM Utilisateur WHERE id=:id";

                $co->executeQuery($query, array(':id' => array($id, PDO::PARAM_STR)));

                $results = $co->getResults();

                foreach($results as $row){
                    $usr = new Utilisateur($row['id'], $row['nom'], $row['pwd']);
                }
            }
            catch(PDOException $Exception){
                echo 'erreur';
                echo $Exception->getMessage();
            }

        }
        return $usr;
    }

    function getUtilisateurbyName(string $nom) : ?Utilisateur {
        $usr = null;
        $tabList= null;
        try{
            $co = $this->co;

            $queryLists="SELECT id, nom FROM Liste WHERE nomCreateur=:nomCrea";
            $queryUser = "SELECT * FROM Utilisateur WHERE nom=:nom";

            $co->executeQuery($queryLists,array('nomCrea'=>array($nom,PDO::PARAM_STR)));
            $res = $co->getResults();
            foreach($res as $row){
                $tabList[]= new Liste($row['id'],$row['nom'],$nom,array());
            }
            $co->executeQuery($queryUser, array('nom' => array($nom, PDO::PARAM_STR)));

            $results = $co->getResults();

            foreach($results as $row){
                $usr = new Utilisateur($row['nom'], $row['pwd'],$tabList);
            }
        }
        catch(PDOException $Exception){
            echo 'erreur';
            echo $Exception->getMessage();
        }
        return $usr;
    }

}

?>
<?php

require_once("Connection.php");
require_once("Utilisateur.php");

class UserGateway {
    private $co;

    public function __construct(Connection $co) { 
        $this->co = $co; 
    } 

    public function creerUtilisateur(int $id, string $nom, string $pwd){
        if(!empty($id) && !empty($nom) && empty($password)){
            try{
                $co = $this->co;

                $query = "INSERT INTO Utilisateur VALUES (:id, :nom, :pwd)";

                $co->executeQuery($query, array(':id' => array($id, PDO::PARAM_STR), ':nom' => array($nom, PDO::PARAM_STR), ':pwd' => array($pwd, PDO::PARAM_STR)));
            }
            catch(PDOException $Excception){
                echo 'erreur';
                echo $Exception->getMessage();
            }
        }
    }

    public function delUtilisateur(int $id){
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

    public function putUtilisateur(Utilisateur $usr){
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

    public function getUtilisateurById(int $id) : Utilisateur {
        $usr = null;
        if(!empty($id)){
            try{
                $co = $this->co;

                $query = "SELECT * FROM Utilisateur WHERE id=:id";

                $co->executeQuery($query, array(':id' => array($id, PDO::PARAM_STR)));

                $results = $co->getResults();

                Foreach($results as $row){
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

    public function getUtilisateurbyNameAndPassword(string $nom, string $pwd) : Utilisateur {
        $usr = null;
        if(!empty($nom) && !empty($password)){
            try{
                $co = $this->co;

                $query = "SELECT * FROM Utilisateur WHERE nom=:nom AND pwd=:pwd";

                $co->executeQuery($query, array(':nom' => array($nom, PDO::PARAM_STR), ':pwd' => array($pwd, PDO::PARAM_STR)));

                $results = $co->getResults();

                Foreach($results as $row){
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

}

?>
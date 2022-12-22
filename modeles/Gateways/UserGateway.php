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
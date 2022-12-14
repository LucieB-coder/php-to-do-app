<?php

require_once("Connection.php");

class ListeGateway {
    private $co;

    public function __construct(Connection $co) { 
        $this->co = $co; 
    } 

    public function getPublicLists():array{
        $listes = array();
        $taches = null;
        try {
            $co = $this->co;

            $query = "SELECT * FROM Liste WHERE nomCreateur IS NULL";

            $co->executeQuery($query, []);

            $results = $co->getResults();

            foreach($results as $row){
                $idListe = $row['id'];
                $queryTaches = "SELECT * FROM Tache WHERE idListe=:idListe";
                $co->executeQuery($queryTaches, array(':idListe' => array($idListe, PDO::PARAM_INT)));
                $resultsTaches = $co->getResults();

                foreach($resultsTaches as $rowTaches){
                    if($rowTaches['complete']=="0"){
                        $taches[] = new Tache($rowTaches['id'], $rowTaches['nom'],false,$idListe);
                    }else{
                        $taches[] = new Tache($rowTaches['id'], $rowTaches['nom'],true,$idListe);
                    }
                    
                }

                $listes[] = new Liste($row['id'], $row['nom'],null, $taches);
                $taches = null;
            }
        }
        catch(PDOException $Exception) {
            echo 'erreur';
            echo $Exception->getMessage();
        }

        return $listes;
    }

    public function getByCreator(string $usr) : array {
        $listes = array();
        $taches = null;
        try {
            $co = $this->co;

            $query = "SELECT * FROM Liste WHERE nomCreateur=:nomCrea";

            $co->executeQuery($query, array('nomCrea' => array($usr, PDO::PARAM_STR)));

            $results = $co->getResults();

            foreach($results as $row){
                $idListe = $row['id'];
                $queryTaches = "SELECT * FROM Tache WHERE idListe=:idListe";
                $co->executeQuery($queryTaches, array(':idListe' => array($idListe, PDO::PARAM_INT)));
                $resultsTaches = $co->getResults();

                foreach($resultsTaches as $rowTaches){
                    if($rowTaches['complete']=="0"){
                        $taches[] = new Tache($rowTaches['id'], $rowTaches['nom'],false,$idListe);
                    }else{
                        $taches[] = new Tache($rowTaches['id'], $rowTaches['nom'],true,$idListe);
                    }
                    
                }

                $listes[] = new Liste($row['id'], $row['nom'],$usr, $taches);
                $taches = null;
            }
        }
        catch(PDOException $Exception) {
            echo 'erreur';
            echo $Exception->getMessage();
        }
    
        return $listes;
    }

    public function getById($id){
        $taches=null;
        $liste=null;
        $co = $this->co;
        $query = "SELECT * FROM Liste WHERE id=:id";

        $co->executeQuery($query, array('id' => array($id, PDO::PARAM_INT)));

        $results = $co->getResults();
        foreach ($results as $row){
            $idListe = $row['id'];
            $queryTaches = "SELECT * FROM Tache WHERE idListe=:id";
            $co->executeQuery($queryTaches, array(':id' => array($idListe, PDO::PARAM_INT)));
            $resultsTaches = $co->getResults();

            foreach($resultsTaches as $rowTaches){
                if($rowTaches['complete']=="0"){
                    $taches[] = new Tache($rowTaches['id'], $rowTaches['nom'],false,$idListe);
                }else{
                    $taches[] = new Tache($rowTaches['id'], $rowTaches['nom'],true,$idListe);
                }
                
            }

            $liste = new Liste($row['id'], $row['nom'],$row['nomCreateur'], $taches);
        }
        return $liste;
    }

    public function creerTache(string $nom, int $idListe){
        try{
            $co = $this->co;

            $query = "INSERT INTO Tache VALUES (NULL, :intitule, 0,:idListe)";

            $co->executeQuery($query, array(':intitule' => array($nom, PDO::PARAM_STR),
                                            'idListe' => array($idListe,PDO::PARAM_INT)));
        }
        catch(PDOException $Exception){
            echo 'erreur';
            echo $Exception->getMessage();
        }
    }

    public function delTache(int $id){
        try{
            $co = $this->co;

            $query = "DELETE FROM Tache WHERE id=:id";

            $co->executeQuery($query, array(':id' => array($id, PDO::PARAM_STR)));
        }
        catch(PDOException $Exception){
            echo 'erreur';
            echo $Exception->getMessage();
        }
    }

    public function updateTache(int $id, bool $complete){
            try{
                $co = $this->co;
                if($complete==true){
                    $query = "UPDATE Tache SET complete=0 WHERE id=:id";
                }
                else{
                    $query = "UPDATE Tache SET complete=1 WHERE id=:id";
                }
                

                $co->executeQuery($query, array(':id' => array($id, PDO::PARAM_STR)));
            }
            catch(PDOException $Exception){
                echo 'erreur';
                echo $Exception->getMessage();
            }
    }

    public function getTacheById(int $id){
        $complete=null;
        $co=$this->co;
        $query="SELECT complete FROM Tache WHERE id=:id";
        $co->executeQuery($query,array('id'=>array($id,PDO::PARAM_INT)));
        $res=$co->getResults();
        foreach($res as $row){
            $complete=$row['complete'];
        }
        if($complete=="0")
        {
            return false;
        }
        else{
            return true;
        }
    }

    public function creerListe(string $nom, ?string $nomCreator){
            try{
                $co = $this->co;

                $insertQuery = "INSERT INTO Liste VALUES (NULL, :nom, :nomCreator)";


                $co->executeQuery($insertQuery, array('nom' => array($nom, PDO::PARAM_STR), 
                                                'nomCreator' => array($nomCreator, PDO::PARAM_STR)));
            }
            catch(PDOException $Exception){
                echo 'erreur';
                echo $Exception->getMessage();
            }
    }
    

    public function delListe(int $id){
        try{
            $co = $this->co;
            $queryDelTaches="DELETE FROM Tache WHERE idListe=:id";
            $query = "DELETE FROM Liste WHERE id=:id";
            $co->executeQuery($queryDelTaches, array(':id' => array($id, PDO::PARAM_STR)));
            $co->executeQuery($query, array(':id' => array($id, PDO::PARAM_STR)));
        }
        catch(PDOException $Exception){
            echo 'erreur';
            echo $Exception->getMessage();
        }
    }
}

?>
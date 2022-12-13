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

    public function creerTache(string $intitule){
        if(!empty($id) && !empty($intitutle)){
            try{
                $co = $this->co;

                $query = "INSERT INTO Tache VALUES (NULL, :intitule, 0)";

                $co->executeQuery($query, array(':intitule' => array($nom, PDO::PARAM_STR)));
            }
            catch(PDOException $Exception){
                echo 'erreur';
                echo $Exception->getMessage();
            }
        }
    }

    public function delTache(int $id){
        if(!empty($id)){
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
    }

    public function completeTache(int $id){
        if(!empty($id)){
            try{
                $co = $this->co;

                $query = "UPDATE Tache SET isCompleted=true WHERE id=:id";

                $co->executeQuery($query, array(':id' => array($id, PDO::PARAM_STR)));
            }
            catch(PDOException $Exception){
                echo 'erreur';
                echo $Exception->getMessage();
            }
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
        if(!empty($id)){
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
    }
}

?>
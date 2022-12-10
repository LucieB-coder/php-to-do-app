<?php

require_once("Connection.php");

class ListeGateway {
    private $co;

    public function __construct(Connection $co) { 
        $this->co = $co; 
    } 

    public function getByCreator(int $idUsr) : array {
        $listes = null;
        $taches = null;
        if(!empty($idUsr)){
            try {
                $co = $this->co;

                $query = "SELECT idListe FROM HasList WHERE idUser=:idUser";

                $co->executeQuery($query, array(':id' => array($id, PDO::PARAM_STR)));

                $results = $co->getResults();

                Foreach($results as $row){
                    $idListe = $row['idListe'];
                    $queryTaches = "SELECT t.* FROM Tache t, HasTache h WHERE t.id=h.idTache AND h.idListe=:idListe";
                    $co->executeQuery($queryTaches, array(':idListe' => array($idListe, PDO::PARAM_STR)));
                    $resultsTaches = $co->getResults();

                    Foreach($resultsTaches as $rowTaches){
                        $taches[] = new Tache($rowTaches['id'], $rowTaches['intitule'], $rowTaches['isCompleted'], $rowTaches['description']);
                    }

                    $listes[] = new Liste($row['id'], $row['nom'], $taches);
                    $taches = null;
                }
            }
            catch(PDOException $Exception) {
                echo 'erreur';
                echo $Exception->getMessage();
            }
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

    public function creerListe(string $nom, int $idCreator){
            try{
                $co = $this->co;

                $insertQuery = "INSERT INTO Liste VALUES (NULL, :nom, :idCreator)";


                $co->executeQuery($insertQuery, array('nom' => array($nom, PDO::PARAM_STR), 
                                                'idCreator' => array($idCreator, PDO::PARAM_INT)));
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
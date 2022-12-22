<?php

class ListeModel{
    private $listgw;

    function __construct(){
        global $rep,$vues,$bd;
        $co = new Connection($bd['dsn'],$bd['user'],$bd['pswd']);
        $this->listgw = new ListeGateway($co);
    }

    public function get_gtwListe(){
        return $this->listgw;
    }

    function creerListe(string $nom, $private){
        if(isset($_SESSION['login'])){
            if($private!=null){
                $this->get_gtwListe()->creerListe($nom,$_SESSION['login']);
            }else{
                $this->get_gtwListe()->creerListe($nom,null);
            }
        }else{
            $this->get_gtwListe()->creerListe($nom,null);
        }
    }

    function creerListePv($nom,$idCeator){
        $this->get_gtwListe()->creerListe($nom,$idCreator);
    }

    public function pullPublicLists(){
        return $this->get_gtwListe()->getPublicLists();
    }

    function pullListesPrivees($nom){
        $listes=$this->get_gtwListe()->getByCreator($nom);
        return $listes;
    }

    function pullListById(int $idListe){
        return $this->get_gtwListe()->getById($idListe);
    }

    function delListe(int $idListe){
        $this->get_gtwListe()->delListe($idListe);
    }
}

?>
<?php

class ListeModel{
    public $listgw;

    function __construct(){
        global $rep,$vues,$bd;
        $co = new Connection($bd['dsn'],$bd['user'],$bd['pswd']);
        $this->listgw = new ListeGateway($co);
    }

    function creerListe(string $nom, $private){
        if(isset($_SESSION['login'])){
            if($private!=null){
                $this->listgw->creerListe($nom,$_SESSION['login']);
            }else{
                $this->listgw->creerListe($nom,null);
            }
        }else{
            $this->listgw->creerListe($nom,null);
        }
    }

    function pullListById(int $idListe){
        return $this->listgw->getById($idListe);
    }

    function addTache(string $intitule, int $idListe ){
        $this->listgw->creerTache($intitule,$idListe);
    }

    function delTache(int $idTache){
        $this->listgw->delTache($idTache);
    }

    function changeCompletedTache(int $idTache){
        $complete=$this->listgw->getTacheById($idTache);
        $this->listgw->updateTache($idTache,$complete);
    }

    function delListe(int $idListe){
        $this->listgw->delListe($idListe);
    }
}

?>
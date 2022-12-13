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
            if($private="on"){
                $this->listgw->creerListe($nom,$_SESSION['login']);
            }else{
                $this->listgw->creerListe($nom,null);
            }
        }else{
            $this->listgw->creerListe($nom,null);
        }
    }
}

?>
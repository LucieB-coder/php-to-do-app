<?php

class UserModel{
    public $listgw;
    public $usergw;

    public function __construct(){
        $co = new Connection();
        $this->usergw = new UserGateway($co);
        $this->listgw = new ListeGateway($co);
    }

    public function deconnection(){
        session_unset();
        session_destroy();
        $_SESSION = array();
    }

    public function creerListePv($nom,$idCeator){
        $this->listgw->creerListe($nom,$idCreator);
    }

    public function desinscription($login){
        $this->usergw->delUtilisateur($login);
    }
}

?>
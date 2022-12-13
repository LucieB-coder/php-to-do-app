<?php

class UserModel{
    public $listgw;
    public $usergw;

    function __construct(){
        global $rep,$vues,$bd;
        $co = new Connection($bd['dsn'],$bd['user'],$bd['pswd']);
        $this->usergw = new UserGateway($co);
        $this->listgw = new ListeGateway($co);
    }

    function deconnection(){
        session_unset();
        session_destroy();
        $_SESSION = array();
    }

    function creerListePv($nom,$idCeator){
        $this->listgw->creerListe($nom,$idCreator);
    }

    function desinscription($login){
        $this->usergw->delUtilisateur($login);
    }

    function changerPassword($newPassword){
        $this->usergw->putPassword($newPassword);
    }

    function pullListesPrivees($nom){
        $listes=$this->listgw->getByCreator($nom);
        return $listes;
    }
}

?>
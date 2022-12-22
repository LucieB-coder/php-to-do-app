<?php

class UserModel{
    private $usergw;

    function __construct(){
        global $rep,$vues,$bd;
        $co = new Connection($bd['dsn'],$bd['user'],$bd['pswd']);
        $this->usergw = new UserGateway($co);
    }

    public function get_UserGw(){
        return $this->usergw;
    }

    function deconnection(){
        session_unset();
        session_destroy();
        $_SESSION = array();
    }

    public function getHashedPassword(string $usr){
        return $this->get_UserGw()->getHashedPassword($usr);
    }

    public function existUser(string $usr):bool{
        if($this->get_UserGw()->getUtilisateurNom($usr) != null){
            return true;
        }
        return false;
    }

    public function connexion($login){
        $_SESSION['role'] = 'Utilisateur';
        $_SESSION['login'] = $login;
    }


    public function inscription($login, $mdp){
        $result=$this->get_UserGw()->creerUtilisateur($login, $mdp);
        if ($result ==true){
            $_SESSION['role'] = 'Utilisateur';
            $_SESSION['login'] = $login;
        }
    }

    
}

?>
<?php

    class VisiteurModel {
        public $gtwUsr;
        public $gtwListe;

        public function __construct() {
            global $rep,$vues,$bd;
            $co = new Connection($bd['dsn'],$bd['user'],$bd['pswd']);
            $this->gtwUsr = new UserGateway($co);
            $this->gtwListe = new ListeGateway($co);
        }

        public function getHashedPassword(string $usr){
            return $this->gtwUsr->getHashedPassword($usr);
        }

        public function existUser(string $usr):bool{
            if($this->gtwUsr->getUtilisateurNom($usr) != null){
                return true;
            }
            return false;
        }

        public function connexion($login){
            $_SESSION['role'] = 'Utilisateur';
            $_SESSION['login'] = $login;
        }

        public function pullPublicLists(){
            return $this->gtwListe->getPublicLists();
        }

        public function inscription($login, $mdp){
            $result=$this->gtwUsr->creerUtilisateur($login, $mdp);
            if ($result ==true){
                $_SESSION['role'] = 'Utilisateur';
                $_SESSION['login'] = $login;
            }
        }

        public function supprListe($id) {
            $this->get_gtwListe()->delListe($id);
        }

        public function creerTache(string $intitule){
            $this->get_gtwListe()->creerTache($intitule);
        }
    }

?>
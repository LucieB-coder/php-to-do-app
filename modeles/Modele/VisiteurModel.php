<?php

    class VisiteurModel {
        private $gtwUsr;
        private $gtwListe;

        public function __construct() {
            $co = new Connection();
            $this->gtwUsr = new UserGateway($co);
            $this->gtwListe = new ListeGateway($co);
        }

        public function get_gtwUsr(): UserGateway {
            return $this->gtwUsr;
        }

        public function get_gtwListe(): ListeGateway {
            return $this->gtwListe;
        }

        public function connexion($login, $mdp){
            $results = $this->get_gtwUsr()->getUtilisateurbyNameAndPassword($login, $mdp);
            if ($results != NULL){
                $_SESSION['role'] = 'user';
                $_SESSION['login'] = $login;
                return true;
            }
            return false;
        }

        public function inscription($login, $mdp){
            $this->get_gtwUsr()->creerUtilisateur($login, $mdp);
        }

        public function creerListe($nom) {
            $this->get_gtwListe()->creerListe($nom, NULL);
        }

        public function supprListe($id) {
            $this->get_gtwListe()->delListe($id);
        }

        public function creerTache(string $intitule){
            $this->get_gtwListe()->creerTache($intitule);
        }

        public function cocherTache($id){
            $this->get_gtwListe()->completeTache($id);
        }

        public function decocherTache($id){
            $this->get_gtwListe()->decocherTache($id);
        }

        public function supprTache($id){
            $this->get_gtwListe()->delTache($id);
        }
    }

?>
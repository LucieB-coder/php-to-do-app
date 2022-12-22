<?php

    class TacheModel {
        private $gwList;

        public function __construct() {
            global $rep,$vues,$bd;
            $co = new Connection($bd['dsn'],$bd['user'],$bd['pswd']);
            $this->gwList = new ListeGateway($co);
        }

        public function get_gwList(){
            return $this->gwList;
        }

        function addTache(string $intitule, int $idListe ){
            $this->get_gwList()->creerTache($intitule,$idListe);
        }
    
        function delTache(int $idTache){
            $this->get_gwList()->delTache($idTache);
        }

        function changeCompletedTache(int $idTache){
            $complete=$this->get_gwList()->getTacheById($idTache);
            $this->get_gwList()->updateTache($idTache,$complete);
        }

        
    }

?>
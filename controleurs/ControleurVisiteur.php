<?php

class VisitorController {
    
    public function __construct() {
        global $rep,$vues;
        //On démarre la session
        session_sart();
        $arrayErrorViews= array();

        try{
            $action = $_REQUEST['action']??null;
            switch($action){
                case NULL:
                    $this->reinit();
                    break;
                case "connection":
                    $this->connection($arrayErrorViews);
                    break;
                case "creerListePublique":
                    $this->creerListe($arrayErrorViews);
                    break;
                case "supprListePublique":
                    $this->supprListe($arrayErrorViews);
                    break;
                default :
                    $arrayErrorViews[]="Erreur innatendue !!!";
                    require($rep.$vues['error']);
            }
        }catch(PDOException $e){
                $dataView[]="Erreur inatendue";
                require($rep.$vues['erreur']);
        }
    }

    public function reinit(){
        global $rep,$vues;
        require($rep.$vues['acceuil']);
    }

    public function connection(array $vues_erreur){
        global $rep,$vues;
        require($rep.$vues['connection']);

    }
}

?>
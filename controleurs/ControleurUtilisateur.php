<?php

class UserController{
    
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
                case "deconnection":
                    $this->deconnection($arrayErrorViews);
                    break;
                case "creerListePrivee":
                    $this->creerListe($arrayErrorViews);
                    break;
                case "supprListe":
                    $this->supprListe($arrayErrorViews);
                    break;
                case "cocherTache":
                default :
                    $arrayErrorViews[]="Erreur innatendue !!!";
                    require($rep.$vues['error']);
            }
            */
        }catch(PDOException $e){
                $dataView[]="Erreur inatendue";
                require(__DIR__.'/../vues/erreur.php');
        }
    } 
}

?>
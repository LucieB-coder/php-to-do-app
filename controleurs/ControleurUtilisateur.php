<?php

class UserController extends VisitorController{
    
    public function __construct() {
        global $rep,$vues;
        //On démarre la session
        session_sart();
        $arrayErrorViews= array();

        try{
            $action = $_REQUEST['action']??null;
            /*
            switch($action){
                case NULL:
                    $this->Reinit();
                    break;
                case "deconnection":
                    $this->deconnection($arrayErrorViews);
                    break;
                case "creerListe":
                    $this->creerListe($arrayErrorViews);
                    break;
                case "supprListe":
                    $this->supprListe($arrayErrorViews);
                    break;
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
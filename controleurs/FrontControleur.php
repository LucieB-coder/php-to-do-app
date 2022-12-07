<?php

require('ControleurUtilisateur.php');
require('ControleurVisiteur.php');


class FrontControleur{

    public function __construct(){
        //On démarre la session
        session_start();
        $liste_actions_utilisateur = array('deconnection','crerListePv','desinscription','changerPassword');
        $liste_actions_visiteur = array('creerListe','suprrListe','connection','inscription','creerTache','cocherTache','supprTache');
        global $rep,$vues;
        try{
            $action = isset($_REQUEST['action']) ? (string)$_REQUEST['action']: null;
            
            if (in_array($action,$liste_actions_utilisateur)){
                if( !isset($_SESSION['login'])){
                    new VisitorController();
                } else {
                    new UserController();
                }
            } else{
                new VisitorController();
            }
        } catch (Exception $e){require ($rep.$vues['erreur']);}
    }

}

?>
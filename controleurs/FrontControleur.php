<?php

require('modeles/Modele/UserModel.php');
require('modeles/Modele/VisiteurModel.php');


class FrontControleur{

    public function __construct(){
        $liste_actions_utilisateur = array('deconnection','crerListePv','desinscription','changerPassword');
        $liste_actions_visiteur = array('creerListe','suprrListe','connection','inscription','creerTache','cocherTache','supprTache');
        global $rep,$vues;
        try{
            $user = $_SESSION['login'];
            $action = $_REQUEST['action'];
            
            if (in_array($action,$liste_actions_utilisateur)){
                if($user == null){
                    new VisiteurController();
                } else {
                    new UserController();
                }
            } else{
                new VisiteurController();
            }
        } catch (Exception $e){require ($rep.$vues['erreur']);}
    }

}

?>
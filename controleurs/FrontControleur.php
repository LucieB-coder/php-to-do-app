<?php

class FrontControleur{

    public function __construct(){
        $liste_actions_utilisateur = array('accessPrivateLists','accessProfilePage','deconnection','crerListePv','desinscription','changerPassword');
        $liste_actions_visiteur = array('accessCreationListePage','accessInscription','accessConnectionPage','creerListe','suprrListe','connection','inscription','creerTache','cocherTache','supprTache');
        global $rep,$vues,$bd,$dataView,$styles,$assets;
        session_start();
        try{
            $user=$_SESSION??null;
            $action = !empty($_REQUEST['action']) ? (string)$_REQUEST['action']:null;
            
            if (in_array($action,$liste_actions_utilisateur)){
                if($user == null){
                    new ControleurVisiteur();
                } else {
                    new ControleurUtilisateur();
                }
            } else{
                new ControleurVisiteur();
            }
        } catch (Exception $e){require ($rep.$vues['erreur']);}
    }

}

?>
<?php

class FrontControleur{

    public function __construct(){
        $liste_actions_utilisateur = array('accessPrivateLists','crerListePv');
        $liste_actions_visiteur = array('goHome','changeCompletedTache','accessCreationTachePage','addTache','delTache','accessListInfos','accessCreationListePage','accessInscription','accessConnectionPage','creerListe','delListe','connection','inscription','deconnection');
        global $rep,$vues,$bd,$dataView,$styles,$assets;
        session_start();
        try{
            $user=$_SESSION??null;
            $action = $_REQUEST['action'];
            
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
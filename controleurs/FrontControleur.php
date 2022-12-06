<?php

class FrontControleur{

    public function __construct(){
        $liste_actions_utilisateur = array('deconnecter','crerListePrivee','supprListeprivee');
        $liste_actions_visiteur = array('ajoutListe','suprrListe','connecter');
        global $rep,$vues;
        require($rep.$vues['acceuil']);
        try{
            $utilisateur = UserModel::IsUtilisateur(); 
            $action = $_REQUEST['action'];
            
            if (in_array($action,$liste_actions_utilisateur)){
                if($utilisateur == null){
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
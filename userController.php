<?php

class UserController{
    
    public function __construct() {

        // Code du controlleur


        //On démarre la session
        session_sart();


        try{
            $action = $_REQUEST['action'];
            switch($action){
                case NULL:
                    $this->action();
                    break;
                case "connection":
                    $this->connection(/* valeurs du login et du mdp dans le formulaire */);
                    break;
            }catch(PDOException $e){
                $dataView[]="Erreur inatendue";
                require(__DIR__.'/../vues/erreur.php');
            }
        }
    }

    public function connection(string $login, string $password){
        
        /* Doit faire:
            * vider les input du formulaire
            * vérifier avec la bd qu'il y a bien un user 
        */

    }
}

?>
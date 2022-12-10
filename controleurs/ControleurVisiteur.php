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
                case "inscription":
                    $this->inscription($arrayErrorViews);
                case "creerListe":
                    $this->creerListe($arrayErrorViews);
                    break;
                case "supprListe":
                    $this->supprListe($arrayErrorViews);
                    break;
                case "creerTache":
                    $this->creerTache($arrayErrorViews);
                    break;
                case "cocherTache":
                    $this->cocherTache($arrayErrorViews);
                    break;
                case "supprTache":
                    $this->supprTache($arrayErrorViews);
                default :
                    $arrayErrorViews[]="Erreur innatendue !!!";
                    require($rep.$vues['error']);
            }
        } catch(PDOException $e){
                $dataView[]="Erreur inatendue";
                require(__DIR__.'/../vues/erreur.php');
        } 
        exit(0);
    }

    public function reinit(){
        global $rep,$vues;
        require($rep.$vues['acceuil']);
    }

    public function connection(array $vues_erreur){
        global $rep,$vues;
        
        $usrname=$_POST['login']; 
        $pwd=$_POST['mdp'];
        Validation::clear_string($pwd);
        Validation::val_connexion($usrname,$pwd,$vues_erreur);

        $model = new UserModel();
        $worked=$model->connexion();
        /* Utiliser si jamais connexion n'a pas marché et qu'on veut remettre le login dans la page pour que le visiteur n'ait pas à le retaper
        $dVue = array (
            'username' => $usrname,
        );
        */
        if($worked==false){
            require('erreur.php');
        }
    }

    public function inscription(array $vues_erreur){
        global $rep,$vues;
        
        $usrname=$_POST['login']; 
        $pwd=$_POST['mdp'];
        Validation::val_connexion($usrname,$pwd,$vues_erreur);

        $model = new UserModel();
        $model->inscription();
    }

    public function creerListe(array $vues_erreur){
        global $rep, $vues;
        require($rep.$vues['creationListe']);

        $nom=$_POST['nom'];
        
        $model = new ListeModel();
        $model->creerListe($nom);
    }

    public function supprListe(array $vues_erreur){
        global $rep, $vues;
        require($rep.$vues['suppressionListe']);

        $model = new ListeModel();
        $model->supprListe();        
    }

    public function creerTache(array $vues_erreur){
        global $rep, $vues;
        require($rep.$vues['creerTache']);

        $intitule = $_POST['intitule'];

        $model = new ListeModel();
        $model->creerTache();
    }
}

?>
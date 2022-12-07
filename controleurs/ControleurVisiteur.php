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
                    break;
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
                case "decocherTache":
                    $this->decocherTache($arrayErrorViews);
                    break;
                case "supprTache":
                    $this->supprTache($arrayErrorViews);
                default :
                    $arrayErrorViews[]="Erreur innatendue !!!";
                    require($rep.$vues['error']);
            }
        } catch(PDOException $e){
                $dataView[]="Erreur inatendue";
                require('erreur.php');
        } 
        exit(0);
    }

    public function reinit(){
        global $rep,$vues;
        require($rep.$vues['acceuil.php']);
    }

    public function connection(array $vues_erreur){
        global $rep,$vues;
        
        $usrname=$_POST['login']; 
        $pwd=$_POST['mdp'];
        Validation::clear_string($pwd);
        Validation::val_connexion($usrname,$pwd,$vues_erreur);

        $model = new VisiteurModel();
        $worked=$model->connexion();
        /*
        $dVue = array (
            'username' => $usrname,
            'password' => $pwd, 
            'worked' => $worked,
        );
        */
        if($worked==false){
            require('erreur.php');
        }
    }

    public function inscription(array $vues_erreur){
        global $rep,$vues;
        require($rep.$vues['inscription']);
        
        $usrname=$_POST['login']; 
        $pwd=$_POST['mdp'];
        Validation::val_connexion($usrname,$pwd,$vues_erreur);

        $model = new VisiteurModel();
        $model->inscription();
    }

    public function creerListe(array $vues_erreur){
        global $rep, $vues;
        require($rep.$vues['creationListe']);

        $nom=$_POST['nom'];
        
        $model = new VisiteurModel();
        $model->creerListe($nom);
    }

    public function supprListe(array $vues_erreur){
        global $rep, $vues;
        require($rep.$vues['suppressionListe']);

        $model = new VisiteurModel();
        $model->supprListe();        
    }

    public function creerTache(array $vues_erreur){
        global $rep, $vues;
        require($rep.$vues['creerTache']);

        $intitule = $_POST['intitule'];

        $model = new VisiteurModel();
        $model->creerTache();
    }

    public function cocherTache(array $vues_erreur){
        global $rep, $vues;
        require($rep.$vues['liste']);

        $id = $_POST['idTache'];

        $model = new VisiteurModel();
        $model->cocherTache($id);
    }

    public function decocherTache(array $vues_erreur){
        global $rep, $vues;
        require($rep.$vues['liste']);

        $id = $_POST['idTache'];

        $model = new VisiteurModel();
        $model->decocherTache($id);
    }

    public function supprTache(array $vues_erreur){
        global $rep, $vues;
        require($rep.$vues['liste']);

        $id = $_POST['idTache'];

        $model = new VisiteurModel();
        $model->supprTache($id);
    }
}

?>
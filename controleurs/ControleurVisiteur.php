<?php

class ControleurVisiteur {
    
    public function __construct() {
        global $rep,$vues,$styles,$assets;
        $arrayErrorViews= array();
        try{
            $action = $_REQUEST['action']??null;
            switch($action){
                case NULL:
                    $this->reinit();
                    break;
                case 'accessConnectionPage':
                    require($rep.$vues['connection']);
                    break;
                case "accessInscription":
                    require($rep.$vues['inscription']);
                    break;
                case "accessCreationListePage":
                    require($rep.$vues['creationListe']);
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
                    require($rep.$vues['acceuil']);
            }
        } catch(PDOException $e){
                $dataView[]="Erreur inatendue";
                require(__DIR__.'/../vues/erreur.php');
        } 
        exit(0);
    }

    public function reinit(){
        global $rep,$vues,$dataView;
        $model = new VisiteurModel();
        $dataView = $model->pullPublicLists();
        require($rep.$vues['acceuil']);

    }

    public function connection(array $vues_erreur){
        global $rep,$vues,$dataView;
        $usrname=$_POST['login']; 
        $pwd=$_POST['mdp'];
        Validation::clear_string($pwd);
        Validation::val_connexion($usrname,$pwd,$vues_erreur);
        $model= new VisiteurModel();
        if($model->existUser($usrname)){
            if(password_verify($pwd,$model->getHashedPassword($usrname))){
                $model->connexion($usrname);
                $_REQUEST['action']=null;
                $this->reinit();
            }
            else{
                $arrayErrorViews =array('username'=>$usrname,'password'=>$pwd);
                require($rep.$vues['erreur']);
            }
        }
        else{
            $arrayErrorViews =array('username'=>$usrname,'password'=>$pwd);
            require($rep.$vues['erreur']);
        }
    }

    public function inscription(array $vues_erreur){
        global $rep,$vues,$dataView;
        $usrname=$_POST['username']; 
        $pwd=$_POST['password'];
        $confirm=$_POST['confirmpassword'];
        $vues_erreur=Validation::val_inscription($usrname,$pwd,$confirm,$vues_erreur);
        if($vues_erreur == []){
            $hash= password_hash($pwd,PASSWORD_DEFAULT);
            $model = new VisiteurModel();
            $model->inscription($usrname,$hash);
        }
        $_REQUEST['action']=null;
        new ControleurVisiteur();
    }

    public function creerListe(array $vues_erreur){
        global $rep, $vues;
        $nom=$_POST['name'];
        $model = new ListeModel();
        if(isset($_SESSION['login'])){
            foreach($_POST['private'] as $valeur){
                $private=$valeur;
                $model->creerListe($nom,$private);
            }
        }
        else{
            $model->creerListe($nom,null);
        }
        $_REQUEST['action']=null;
        $this->reinit();
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
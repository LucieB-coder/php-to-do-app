<?php

class ControleurVisiteur {
    
    public function __construct() {
        global $rep,$vues,$dataView,$styles,$assets;
        $vues_erreur= array();
        try{
            $action = $_REQUEST['action']??null;
            switch($action){
                case NULL:
                    $this->reinit();
                    break;
                case "goHome":
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
                case "accessCreationTachePage":
                    $dataView=$_POST['liste'];
                    require($rep.$vues['creationTache']);
                    break;
                case "addTache":
                    $this->addTache($vues_erreur);
                    break;
                case "accessListInfos":
                    $this->accessListInfos($vues_erreur);
                    break;
                case "delTache":
                    $this->delTache($vues_erreur);
                    break;
                case "changeCompletedTache":
                    $this->changeCompletedTache($vues_erreur);
                    break;
                case "connection":
                    $this->connection($vues_erreur);
                    break;
                case "inscription":
                    $this->inscription($vues_erreur);
                case "creerListe":
                    $this->creerListe($vues_erreur);
                    break;
                case "delListe":
                    $this->delListe($vues_erreur);
                    break;
                case "deconnection":
                    $this->deconnection($vues_erreur);
                    break;
                default :
                    $vues_erreur[]="Erreur innatendue !!!";
                    require($rep.$vues['acceuil']);
            }
        } catch(PDOException $e){
                $dataView[]="Erreur inatendue";
                require(__DIR__.'/../vues/erreur.php');
        } 
        exit(0);
    }


    function deconnection($vues_erreur){
        global $rep, $vues, $dataView;
        $model = new UserModel();
        $retour = $model->deconnection();
        $_REQUEST['action']=null;
        $control= new ControleurVisiteur();
        $vues_erreur= array();
    }

    public function reinit(){
        global $rep,$vues,$dataView,$styles;
        $model = new ListeModel();
        $dataView = $model->pullPublicLists();
        require($rep.$vues['acceuil']);
        $vues_erreur= array();
    }

    public function accessListInfos($vues_erreur){
        global $rep,$vues,$dataView;
        $idListe=$_POST['liste'];
        $model = new ListeModel();
        $dataView = $model->pullListById($idListe);
        require($rep.$vues['infosListe']);
        $vues_erreur= array();
    }

    public function addTache($vues_erreur){
        global $rep,$vues,$dataView;
        $nom=$_POST['name'];
        $idListe=$_POST['liste'];
        $vues_erreur = Validation::val_intitule($nom, $vues_erreur);
        if(!empty($vues_erreur)){
            require($rep.$vues['creationTache']);
        }
        else{
            $model = new TacheModel();
            $model->addTache($nom,$idListe);
            $_REQUEST['action']="accessListInfos";
            $this->accessListInfos($vues_erreur);
            $vues_erreur= array();
        }
        
    }

    public function delTache($vues_erreur){
        global $rep,$vues,$dataView;
        $idTache=$_POST['tache'];
        $model= new TacheModel();
        $model->delTache($idTache);
        $_REQUEST['action']="accessListInfos";
        $this->accessListInfos($vues_erreur);
        $vues_erreur= array();
    }

    public function changeCompletedTache($vues_erreur){
        global $rep,$vues,$dataView;
        $idTache=$_POST['tache'];
        $model = new TacheModel();
        $model->changeCompletedTache($idTache);
        $_REQUEST['action']="accessListInfos";
        $this->accessListInfos($vues_erreur);
        $vues_erreur= array();
    }

    public function connection(array $vues_erreur){
        global $rep,$vues,$dataView;
        $usrname=$_POST['login']; 
        $pwd=$_POST['mdp'];
        $vues_erreur=Validation::val_connexion($usrname,$pwd,$vues_erreur);
        if(!empty($vues_erreur)){
            require($rep.$vues['connection']);
        }
        $model= new UserModel();
        if($model->existUser($usrname)){
            if(password_verify($pwd,$model->getHashedPassword($usrname))){
                $model->connexion($usrname);
                $_REQUEST['action']=null;
                $this->reinit();
                $vues_erreur= array();
            }
            else{
                $vues_erreur =array('username'=>$usrname,'password'=>$pwd);
                require($rep.$vues['connection']);
            }
        }
        else{
            $vues_erreur =array('username'=>$usrname,'password'=>$pwd);
            require($rep.$vues['connection']);
        }
    }

    public function inscription(array $vues_erreur){
        global $rep,$vues,$dataView;
        $usrname=$_POST['username']; 
        $pwd=$_POST['password'];
        $confirm=$_POST['confirmpassword'];
        $model = new UserModel();
        $vues_erreur=Validation::val_inscription($usrname,$pwd,$confirm,$vues_erreur);
        if($model->existUser($usrname)){
            $vues_erreur[]="Username already taken";
        }
        if(empty($vues_erreur)){
            $hash= password_hash($pwd,PASSWORD_DEFAULT);
            $model->inscription($usrname,$hash);
            $vues_erreur= array();
        }
        else{
            require($rep.$vues['inscription']);
        }
        
        $_REQUEST['action']=null;
        $this->reinit();
    }

    public function creerListe(array $vues_erreur){
        global $rep, $vues;
        $nom=$_POST['name'];
        $vues_erreur=Validation::val_intitule($nom, $vues_erreur);
        if(!empty($vues_erreur)){
            require($rep.$vues['creationListe']);
        }
        else{
            $model = new ListeModel();
            if(isset($_SESSION['login'])){
                $private=$_POST['private'];
                $model->creerListe($nom,$private);
            }
            else{
                $model->creerListe($nom,null);
            }
            $_REQUEST['action']=null;
            $this->reinit();
            $vues_erreur= array();
        }
        
    }

    public function delListe(array $vues_erreur){
        global $rep, $vues;
        $idListe=$_POST['liste'];
        $model = new ListeModel();
        $model->delListe($idListe);
        $_REQUEST['action']=null;
        $this->reinit();  
        $vues_erreur= array();
    }
}

?>
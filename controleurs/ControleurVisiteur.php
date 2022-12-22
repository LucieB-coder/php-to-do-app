<?php

class ControleurVisiteur {
    
    public function __construct() {
        global $rep,$vues,$dataView,$styles,$assets;
        $arrayErrorViews= array();
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
                    $this->addTache($arrayErrorViews);
                    break;
                case "accessListInfos":
                    $this->accessListInfos($arrayErrorViews);
                    break;
                case "delTache":
                    $this->delTache($arrayErrorViews);
                    break;
                case "changeCompletedTache":
                    $this->changeCompletedTache($arrayErrorViews);
                    break;
                case "connection":
                    $this->connection($arrayErrorViews);
                    break;
                case "inscription":
                    $this->inscription($arrayErrorViews);
                case "creerListe":
                    $this->creerListe($arrayErrorViews);
                    break;
                case "delListe":
                    $this->delListe($arrayErrorViews);
                    break;
                case "deconnection":
                    $this->deconnection($arrayErrorViews);
                    break;
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


    function deconnection($arrayErrorViews){
        global $rep, $vues, $dataView;
        $model = new UserModel();
        $retour = $model->deconnection();
        $_REQUEST['action']=null;
        $control= new ControleurVisiteur();
    }

    public function reinit(){
        global $rep,$vues,$dataView,$styles;
        $model = new VisiteurModel();
        $dataView = $model->pullPublicLists();
        require($rep.$vues['acceuil']);

    }

    public function accessListInfos($arrayErrorViews){
        global $rep,$vues,$dataView;
        $idListe=$_POST['liste'];
        $model = new ListeModel();
        $dataView = $model->pullListById($idListe);
        require($rep.$vues['infosListe']);
    }

    public function addTache($arrayErrorViews){
        global $rep,$vues,$dataView;
        $nom=$_POST['name'];
        $idListe=$_POST['liste'];
        $model = new ListeModel();
        $model->addTache($nom,$idListe);
        $_REQUEST['action']="accessListInfos";
        $this->accessListInfos($arrayErrorViews);
    }

    public function delTache($arrayErrorViews){
        global $rep,$vues,$dataView;
        $idTache=$_POST['tache'];
        $model= new ListeModel();
        $model->delTache($idTache);
        $_REQUEST['action']="accessListInfos";
        $this->accessListInfos($arrayErrorViews);
    }

    public function changeCompletedTache($arrayErrorViews){
        global $rep,$vues,$dataView;
        $idTache=$_POST['tache'];
        $model = new ListeModel();
        $model->changeCompletedTache($idTache);
        $_REQUEST['action']="accessListInfos";
        $this->accessListInfos($arrayErrorViews);
    }

    public function connection(array $vues_erreur){
        global $rep,$vues,$dataView;
        $usrname=$_POST['login']; 
        $pwd=$_POST['mdp'];
        $vues_erreur=Validation::val_connexion($usrname,$pwd,$vues_erreur);
        if(!empty($vues_erreur)){
            require($rep.$vues['connection']);
        }
        $model= new VisiteurModel();
        if($model->existUser($usrname)){
            if(password_verify($pwd,$model->getHashedPassword($usrname))){
                $model->connexion($usrname);
                $_REQUEST['action']=null;
                $this->reinit();
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
        $model = new VisiteurModel();
        $vues_erreur=Validation::val_inscription($usrname,$pwd,$confirm,$vues_erreur);
        if($model->existUser($usrname)){
            $vues_erreur[]="Username already taken";
        }
        if(empty($vues_erreur)){
            $hash= password_hash($pwd,PASSWORD_DEFAULT);
            $model->inscription($usrname,$hash);
        }
        else{
            require($rep.$vues['inscription']);
        }
        
        $_REQUEST['action']=null;
        new ControleurVisiteur();
    }

    public function creerListe(array $vues_erreur){
        global $rep, $vues;
        $nom=$_POST['name'];
        $vues_erreur=Validation::val_intitule($nom, $vues_erreur);
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
    }

    public function delListe(array $vues_erreur){
        global $rep, $vues;
        $idListe=$_POST['liste'];
        $model = new ListeModel();
        $model->delListe($idListe);
        $_REQUEST['action']=null;
        $this->reinit();      
    }

    public function creerTache(array $vues_erreur){
        global $rep, $vues;
        require($rep.$vues['creerTache']);

        $intitule = $_POST['intitule'];
        $vues_erreur=Validation::val_intitule($intitule, $vues_erreur);

        $model = new ListeModel();
        $model->creerTache();
    }
}

?>
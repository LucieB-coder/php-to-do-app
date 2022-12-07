<?php

class UserController{
    
    public function __construct() {
        global $rep,$vues;
        //On démarre la session
        session_sart();
        $arrayErrorViews= array();

        try{
            $action = $_REQUEST['action']??null;
            switch($action){
                case "deconnection":
                    $this->deconnection($arrayErrorViews);
                    break;
                case "creerListePv":
                    $this->creerListe($arrayErrorViews);
                    break;
                case "desinscription":
                    $this->desinctription($arrayErrorViews);
                    break;
                case "changerInfos":
                    $this->changerInfos($arrayErrorViews);
                    break;
                default :
                    $arrayErrorViews[]="Erreur innatendue !!!";
                    require($rep.$vues['error']);
            }
        }catch(PDOException $e){
                $dataView[]="Erreur inatendue";
                require($rep.$vues['erreur']);
        }
    } 

    public function deconnection($arrayErrorViews){
        // appeler la méthode deco du modèle
        UserModel::deconnection();
    }

    public function creerListePv($arrayErrorViews){
        global $rep, $vues;
        //recupérer les valeurs du formulaire
        $nomListe=$_POST['ListName'];
        $privee=$_POST['isPrivate'];

        // valider les champs
        Validation::val_creation_Liste_PV($nomListe, $arrayErrorViews);
        // vider les champs
        //Validation::clear_string($_POST['ListName']);
        // appelle à la methode du modèle
        if($privee == true){
            UserModel::creerListePv($nomListe,$_SESSION['login']);
        }else{
            VisitorModel::creerListe($nomListe);
        }
    }

    public function desinscription($arrayErrorViews){
        global $rep, $vues;
        // recup valeurs des champs
        $password=$_POST['password'];
        // valider les champs
        Validation::val_desinscription($password);
        // vider les champs
        //Validation::clear_string($_POST['password']);
        // appel à la classe userModel
        UserModel::desinscription($_SESSION['login']);
    }
}

?>
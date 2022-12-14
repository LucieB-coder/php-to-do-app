<?php

class ControleurUtilisateur{
    
    function __construct() {
        global $rep,$vues, $dataView,$styles,$assets;
        $arrayErrorViews= array();

        $action = $_REQUEST['action']??null;
        switch($action){
            case "accessPrivateLists":
                $this->accessPrivateLists($arrayErrorViews);
            case "accessProfilePage":
                require($rep.$vues['profile']);
                break;
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
                $this->changerPassword($arrayErrorViews);
                break;
            default :
                $arrayErrorViews[]="Erreur innatendue !!!";
                require($rep.$vues['error']);
        }
    } 

    function deconnection($arrayErrorViews){
        global $rep, $vues, $dataView;
        $model = new UserModel();
        $retour = $model->deconnection();
        $_REQUEST['action']=null;
        $control= new ControleurVisiteur();
    }

    function creerListePv($arrayErrorViews){
        global $rep, $vues, $dataView;
        //recupérer les valeurs du formulaire
        $nomListe=$_POST['ListName'];
        $privee=$_POST['isPrivate'];

        // valider les champs
        Validation::val_creation_Liste_PV($nomListe, $arrayErrorViews);
        // vider les champs
        //Validation::clear_string($_POST['ListName']);
        // appelle à la methode du modèle
        if($privee == true){
            try{
                UserModel::creerListePv($nomListe,$_SESSION['login']);
            } catch (PDOException $e){
                $dataView[]="Erreur inatendue";
                require($rep.$vues['erreur']);
            }
        }else{
            try{
                VisitorModel::creerListe($nomListe);
            } catch (PDOException $e){
                $dataView[]="Erreur inatendue";
                require($rep.$vues['erreur']);
            }
        }
    }

    function changerPassword($arrayErrorViews){
        global $rep, $vues, $dataView;
        $password1=$_POST['password1'];
        $passwordConfirm=$_POST['passwordConfirm'];
        $newPassword=Validation::val_changer_password($password1,$passwordConfirm);

        try{
            UserModel::changerPassword($newPassword);
            require($rep.$vues['profil']);
        }catch(PDOException $e){
            $dataView[]="Erreur inatendue";
            require($rep.$vues['erreur']);
        }
    }

    function accessPrivateLists($arrayErrorViews){
        global $rep, $vues, $dataView;
        $model = new UserModel();
        $dataView = $model->pullListesPrivees($_SESSION['login']);
        require($rep.$vues['listesPrivees']);
    }
}

?>
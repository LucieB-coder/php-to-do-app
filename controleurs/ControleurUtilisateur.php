<?php

class ControleurUtilisateur{
    
    function __construct() {
        global $rep,$vues, $dataView,$styles,$assets;
        $arrayErrorViews= array();

        $action = $_REQUEST['action'];
        switch($action){
            case "accessPrivateLists":
                $this->accessPrivateLists($arrayErrorViews);
            
            case "creerListePv":
                $this->creerListe($arrayErrorViews);
                break;
            default:
                $arrayErrorViews[]="Erreur innatendue !!!";
                require($rep.$vues['error']);
        }
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
                ListeModel::creerListePv($nomListe,$_SESSION['login']);
            } catch (PDOException $e){
                $dataView[]="Erreur inatendue";
                require($rep.$vues['erreur']);
            }
        }else{
            try{
                ListeModel::creerListe($nomListe);
            } catch (PDOException $e){
                $dataView[]="Erreur inatendue";
                require($rep.$vues['erreur']);
            }
        }
    }

    function accessPrivateLists($arrayErrorViews){
        global $rep, $vues, $dataView;
        $model = new ListeModel();
        $dataView = $model->pullListesPrivees($_SESSION['login']);
        require($rep.$vues['listesPrivees']);
    }
}

?>
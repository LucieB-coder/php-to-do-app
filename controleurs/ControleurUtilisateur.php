<?php

class UserController{
    
    public function __construct() {
        global $rep,$vues;
        //On démarre la session
        session_sart();
        $arrayErrorViews= array();

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
                $this->changerPassword($arrayErrorViews);
                break;
            default :
                $arrayErrorViews[]="Erreur innatendue !!!";
                require($rep.$vues['error']);
        }
    } 

    public function deconnection($arrayErrorViews){
        // appeler la méthode deco du modèle
        $retour = UserModel::deconnection();
        require($rep.$vues['acceuil']);
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

    public function changerPassword($arrayErrorViews){
        global $rep, $vues;
        $password1=$_POST['password1'];
        $passwordConfirm=$_POST['passwordConfirm'];
        $newPassword=Validation::val_changer_password($password1,$passwordConfirm);

        try{
            UserModel::changerPassword($newPassword);
            require($rep.$vues['profil'])
        }catch(PDOException $e){
            $dataView[]="Erreur inatendue";
            require($rep.$vues['erreur']);
        }
    }
}

?>
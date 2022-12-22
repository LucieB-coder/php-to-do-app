<?php
require_once(__DIR__.'/controleurs/FrontControleur.php');

// Chargement config
require_once(__DIR__.'/config/config.php');

// Autoload des classes
require_once(__DIR__.'/config/Autoload.php');
Autoload::charger();

/*
require_once(__DIR__.'/config/Validation.php');
require_once(__DIR__.'/controleurs/ControleurUtilisateur.php');
require_once(__DIR__.'/controleurs/ControleurVisiteur.php');
require_once(__DIR__.'/controleurs/FrontControleur.php');
require_once(__DIR__.'/modeles/Gateways/Connection.php');
require_once(__DIR__.'/modeles/Gateways/ListeGateway.php');
require_once(__DIR__.'/modeles/Gateways/UserGateway.php');
require_once(__DIR__.'/modeles/Métier/Liste.php');
require_once(__DIR__.'/modeles/Métier/Tache.php');
require_once(__DIR__.'/modeles/Métier/Utilisateur.php');
require_once(__DIR__.'/modeles/Modele/UserModel.php');
require_once(__DIR__.'/modeles/Modele/VisiteurModel.php');
require_once(__DIR__.'/modeles/Modele/ListModel.php');
*/


// Construction du controleur
//$cont=new FrontControleur();
$cont= new FrontControleur();
?>



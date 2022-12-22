<?php
require_once(__DIR__.'/controleurs/FrontControleur.php');

// Chargement config
require_once(__DIR__.'/config/config.php');

// Autoload des classes
require_once(__DIR__.'/config/Autoload.php');
Autoload::charger();

// Construction du controleur
//$cont=new FrontControleur();
$cont= new FrontControleur();
?>



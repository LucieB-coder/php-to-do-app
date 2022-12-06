<?php

// Chargement config
require_once(__DIR__.'/config/config.php');

// Autoload des classes
require_once(__DIR__.'/config/Autoload.php');
Autoload::charger();

// Construction du controleur
$cont=new FrontControleur();
?>



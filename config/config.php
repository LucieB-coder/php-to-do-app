<?php

//Prefixe
$rep=__DIR__.'/../';
//BD
$bd['dsn'] = "mysql:host=localhost;port=8888;dbname=dbPhp";
$bd['user'] = "root";
$bd['pswd'] = "root";
//Vues
$vues['acceuil']='vues/acceuil.php';
$vues['erreur']='vues/erreur.php';
$vues['connection']='vues/connection.php';
$vues['inscription']='vues/inscription.php';
$vues['profile']='vues/profile.php';
$vues['listesPrivees']='vues/listesPrivees.php';
$vues['creationListe']='vues/creationListe.php';
$vues['infosListe']='vues/infosListe.php';
$vues['creationTache']='vues/creationTache.php';
// Styles
$styles['commun']='vues/styles/commonStyles.css';
$styles['connection']='vues/styles/connectionStyle.css';

// Assets
$assets['logo']='assets/chekliste.png';

?>
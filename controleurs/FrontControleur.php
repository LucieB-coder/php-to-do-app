<?php

class FrontControleur{

    public function __construct(){
        global $rep,$vues;
        require($rep.$vues['acceuil']);
    }

}

?>
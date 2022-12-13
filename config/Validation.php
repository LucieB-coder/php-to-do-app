<?php

    class Validation {
        static function val_connexion($usrName,$mdp,&$dataVueEreur) {
            if (!isset($usrName)||$usrName=="") {
                $dataVueEreur[] ="Nom d'utilisateur manquant";
                throw new Exception('pas de username');
            }
            if (!isset($mdp)||$mdp=="") {
                $dataVueEreur[] ="Mot de passe manquant";
                throw new Exception('pas de password');
            }
        }

        static function clear_string($champ){
            return filter_var($champ, FILTER_SANITIZE_SPECIAL_VAR);
        }
    }

?>
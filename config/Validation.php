<?php

    class Validation {
        static function val_connexion($usrName,$mdp,$dataVueEreur) {
            if (!isset($usrName)||$usrName=="") {
                $dataVueEreur[] ="Nom d'utilisateur manquant";
                throw new Exception('pas de username');
            }
            if (!isset($mdp)||$mdp=="") {
                $dataVueEreur[] ="Mot de passe manquant";
                throw new Exception('pas de password');
            }
            return $dataVueEreur;
        }

        static function val_inscription($username,$pwd1,$pwd2,$dataVueEreur){
            if (!isset($username)||$username==="") {
                $dataVueEreur[] ="Nom d'utilisateur manquant";
                throw new Exception('pas de username');
            }
            if (!isset($pwd1)||$pwd1==="") {
                $dataVueEreur[] ="Mot de passe manquant";
                throw new Exception('pas de password');
            }
            if (!isset($pwd2)||$pwd2==="") {
                $dataVueEreur[] ="Confirmation mot de passe manquant";
                throw new Exception('pas de confirmation password');
            }
            if($pwd1 !== $pwd2){
                $dataVueEreur[]="Mot de passe et confirmation différents";
                throw new Exception("Mot de passe et confirmation différents");
            }
            return $dataVueEreur;
        }

        static function clear_string($champ){
            // A changer filter_var
        }
    }

?>
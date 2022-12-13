<?php

    class Validation {
        static function val_connexion($usrName,$mdp,$dataVueEreur) {
            if (!isset($usrName)||$usrName=="") {
                $dataVueEreur[] ="Nom d'utilisateur manquant";
                throw new Exception('pas de username');
            }
            $username = Validation::clear_string($username);
            if($username == false){
                $dataVueEreur[] = "Sanitizing error";
                throw new Exception('sanitizing fail');
            }
            if (!isset($mdp)||$mdp=="") {
                $dataVueEreur[] ="Mot de passe manquant";
                throw new Exception('pas de password');
            }
            $mdp = Validation::clear_string($mdp);
            if($mdp == false){
                $dataVueEreur[] = "Sanitizing error";
                throw new Exception('sanitizing fail');
            }
            return $dataVueEreur;
        }

        static function val_inscription($username,$pwd1,$pwd2,$dataVueEreur){
            if (!isset($username)||$username==="") {
                $dataVueEreur[] ="Nom d'utilisateur manquant";
                throw new Exception('pas de username');
            }
            $username = Validation::clear_string($username);
            if($username == false){
                $dataVueEreur[] = "Sanitizing error";
                throw new Exception('sanitizing fail');
            }
            if (!isset($pwd1)||$pwd1==="") {
                $dataVueEreur[] ="Mot de passe manquant";
                throw new Exception('pas de password');
            }
            $pwd1 = Validation::clear_string($pwd1);
            if($pwd1 == false){
                $dataVueEreur[] = "Sanitizing error";
                throw new Exception('sanitizing fail');
            }
            if (!isset($pwd2)||$pwd2==="") {
                $dataVueEreur[] ="Confirmation mot de passe manquant";
                throw new Exception('pas de confirmation password');
            }
            $pwd2 = Validation::clear_string($pwd2);
            if($pwd2 == false){
                $dataVueEreur[] = "Sanitizing error";
                throw new Exception('sanitizing fail');
            }
            if($pwd1 !== $pwd2){
                $dataVueEreur[]="Mot de passe et confirmation différents";
                throw new Exception("Mot de passe et confirmation différents");
            }
            return $dataVueEreur;
        }

        static function val_intitule($intitule, $dataVueEreur){
            if (!isset($intitule)||$intitule==="") {
                $dataVueEreur[] ="Intitulé manquant";
                throw new Exception('pas d\'intitule');
            }
            $intitule = Validation::clear_string($intitule);
            if($intitule == false){
                $dataVueEreur[] = "Sanitizing error";
                throw new Exception('sanitizing fail');
            }
            return $dataVueEreur;
        }

        static function clear_string($champ){
            return filter_var($champ, FILTER_SANITIZE_SPECIAL_VAR);
        }
    }

?>
<?php

    class Validation {
        static function val_connexion($usrName,$mdp,$dataVueEreur) {
            if (!isset($usrName)||$usrName=="") {
                $dataVueEreur[] ="Username or password missing";
            }
            $usrName = Validation::clear_string($usrName);
            if($usrName == false){
                $dataVueEreur[] = "Sanitizing error";
            }
            if (!isset($mdp)||$mdp=="") {
                $dataVueEreur[] ="Username or password missing";
            }
            $mdp = Validation::clear_string($mdp);
            if($mdp == false){
                $dataVueEreur[] = "Sanitizing error";
            }
            return $dataVueEreur;
        }

        static function val_inscription($username,$pwd1,$pwd2,$dataVueEreur){
            if (!isset($username)||$username==="") {
                $dataVueEreur[] ="All fields are required";
            }
            $username = Validation::clear_string($username);
            if($username == false){
                $dataVueEreur[] = "Sanitizing error";
                throw new Exception('sanitizing fail');
            }
            if (!isset($pwd1)||$pwd1==="") {
                $dataVueEreur[] ="All fields are required";
            }
            $pwd1 = Validation::clear_string($pwd1);
            if($pwd1 == false){
                $dataVueEreur[] = "Sanitizing error";
            }
            if (!isset($pwd2)||$pwd2==="") {
                $dataVueEreur[] ="All fields are required";
            }
            $pwd2 = Validation::clear_string($pwd2);
            if($pwd2 == false){
                $dataVueEreur[] = "Sanitizing error";
            }
            if($pwd1 !== $pwd2){
                $dataVueEreur[]="Invalid confirmation";
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
            return filter_var($champ, FILTER_SANITIZE_STRING);
        }
    }

?>
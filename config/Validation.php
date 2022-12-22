<?php

    class Validation {
        static function val_connexion($usrName,$mdp,$dataVueEreur) {
            if (!isset($usrName)||$usrName=="") {
                $dataVueEreur[] ="Username or password missing";
            }
            if ($usrName != Validation::clear_string($usrName)){
                $dataVueEreur[] = "Forbidden characters";
                $usrName="";
            }
            if (!isset($mdp)||$mdp=="") {
                $dataVueEreur[] ="Username or password missing";
            }
            if($mdp != Validation::clear_string($mdp)){
                $dataVueEreur[] = "Forbidden characters";
                $mdp="";
            }
            return $dataVueEreur;
        }

        static function val_inscription($username,$pwd1,$pwd2,$dataVueEreur){
            if (!isset($username)||$username==="") {
                $dataVueEreur[] ="All fields are required";
            }
            if($username != Validation::clear_string($username)){
                $dataVueEreur[] = "Forbidden characters";
                $username="";
            }
            if (!isset($pwd1)||$pwd1==="") {
                $dataVueEreur[] ="All fields are required";
            }
            if($pwd1 != Validation::clear_string($pwd1)){
                $dataVueEreur[] = "Forbidden characters";
                $pwd1="";
            }
            if (!isset($pwd2)||$pwd2==="") {
                $dataVueEreur[] ="All fields are required";
            }
            if($pwd2 != Validation::clear_string($pwd2)){
                $dataVueEreur[] = "Forbidden characters";
                $pwd2="";
            }
            if($pwd1 !== $pwd2){
                $dataVueEreur[]="Invalid confirmation";
            }
            return $dataVueEreur;
        }

        static function val_intitule($name, $dataVueEreur){
            if (!isset($name)||$name==="") {
                $dataVueEreur[] ="Intitulé manquant";
            }
            if($name != Validation::clear_string($name)){
                $dataVueEreur[] = "Forbidden characters";
                $name="";
            }
            return $dataVueEreur;
        }

        static function clear_string($champ){
            return filter_var($champ, FILTER_SANITIZE_STRING);
        }
    }

?>
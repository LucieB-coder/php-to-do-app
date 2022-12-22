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
            $_POST['username'] = Validation::clear_string($_POST['username']);
            if($_POST['username'] == false){
                $dataVueEreur[] = "Sanitizing error";
                throw new Exception('sanitizing fail');
            }
            if (!isset($pwd1)||$pwd1==="") {
                $dataVueEreur[] ="All fields are required";
            }
            $_POST['password'] = Validation::clear_string($_POST['password']);
            if($_POST['password'] == false){
                $dataVueEreur[] = "Sanitizing error";
            }
            if (!isset($pwd2)||$pwd2==="") {
                $dataVueEreur[] ="All fields are required";
            }
            $_POST['confirmpassword'] = Validation::clear_string($_POST['confirmpassword']);
            if($_POST['confirmpassword'] == false){
                $dataVueEreur[] = "Sanitizing error";
            }
            if($pwd1 !== $pwd2){
                $dataVueEreur[]="Invalid confirmation";
            }
            return $dataVueEreur;
        }

        static function val_intitule($dataVueEreur){
            if (!isset($_POST['name'])||$_POST['name']==="") {
                $dataVueEreur[] ="Intitulé manquant";
                throw new Exception('pas d\'intitule');
            }
            $_POST['name'] = Validation::clear_string($_POST['name']);
            if($_POST['name'] == false){
                $dataVueEreur[] = "Sanitizing error";
                throw new Exception('sanitizing fail');
            }
            return $dataVueEreur;
        }

        static function clear_string($champ){
            return filter_var($champ, FILTER_SANITIZE_SPECIAL_CHARS);
        }
    }

?>
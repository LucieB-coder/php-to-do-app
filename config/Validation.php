<?php

    class Validation {
        static function val_connexion($usrName,$mdp,$dataVueEreur) {
            if (!isset($usrName)||$usrName=="") {
                $dataVueEreur[] ="Nom d'utilisateur manquant";
                throw new Exception('pas de username');
            }
            $usrName = Validation::clear_string($usrName);
            if($usrName == false){
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

        static function val_inscription($dataVueEreur){
            if (!isset($_POST['username'])||$_POST['username']==="") {
                $dataVueEreur[] ="Nom d'utilisateur manquant";
                throw new Exception('pas de username');
            }
            $_POST['username'] = Validation::clear_string($_POST['username']);
            if($_POST['username'] == false){
                $dataVueEreur[] = "Sanitizing error";
                throw new Exception('sanitizing fail');
            }
            if (!isset($_POST['username'])||$_POST['username']==="") {
                $dataVueEreur[] ="Mot de passe manquant";
                throw new Exception('pas de password');
            }
            $_POST['password'] = Validation::clear_string($_POST['password']);
            if($_POST['password'] == false){
                $dataVueEreur[] = "Sanitizing error";
                throw new Exception('sanitizing fail');
            }
            if (!isset($_POST['confirmpassword'])||$_POST['confirmpassword']==="") {
                $dataVueEreur[] ="Confirmation mot de passe manquant";
                throw new Exception('pas de confirmation password');
            }
            $_POST['confirmpassword'] = Validation::clear_string($_POST['confirmpassword']);
            if($_POST['confirmpassword'] == false){
                $dataVueEreur[] = "Sanitizing error";
                throw new Exception('sanitizing fail');
            }
            if($_POST['password'] !== $_POST['confirmpassword']){
                $dataVueEreur[]="Mot de passe et confirmation différents";
                throw new Exception("Mot de passe et confirmation différents");
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
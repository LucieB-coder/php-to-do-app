<?php

Class Utilisateur {
    private string $nom;
    private string $password;
    private $listListe;

    function __construct(string $n, string $p, $liste) {
        $this->nom=$n;
        $this->password=$p;
        $this->listListe=$liste;
    }
    function get_id(): int {
        return $this->id;
    }
    function get_nom(): string {
        return $this->nom;
    }
    function get_password(): string {
        return $this->password;
    }
    function get_listListe(){
        return $this->get_listListe;
    }
}


?>
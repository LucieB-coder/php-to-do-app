<?php

Class Tache {
    public int $id;
    public string $nom;
    public bool $isCompleted;
    public int $idListe;

    function __construct(int $i, string $in, bool $is, int $idListe){
        $this->id = $i;
        $this->nom = $in;
        $this->isCompleted = $is;
        $this->idListe=$idListe;
    }
}

?>
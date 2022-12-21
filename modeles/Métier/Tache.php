<?php

Class Tache {
    private int $id;
    private string $nom;
    private bool $isCompleted;
    private int $idListe;

    public function __construct(int $i, string $in, bool $is, int $idListe){
        $this->id = $i;
        $this->nom = $in;
        $this->isCompleted = $is;
        $this->idListe=$idListe;
    }

    public function get_id():int{
        return $this->id;
    }

    public function get_nom():string{
        return $this->nom;
    }

    public function get_isCompleted():bool{
        return $this->isCompleted;
    }

    public function get_idListe():int{
        return $this->idListe;
    }
}

?>
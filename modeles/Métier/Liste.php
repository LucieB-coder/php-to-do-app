<?php

class Liste {
    private int $id;
    private string $nom;
    private int $idCreator;

    function __construct(int $i, string $n, $t){
        $this->id=$i;
        $this->nom=$n;
        $this->taches=$t;
    }

    function get_id(): int {
        return $this->id;
    }

    function get_nom(): string {
        return $this->nom;
    }

    function get_idCreator(): array {
        return $this->taches;
    }
}

?>
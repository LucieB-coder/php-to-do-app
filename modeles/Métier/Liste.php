<?php

class Liste {
    public int $id;
    public string $nom;
    public ?string $nomCreateur;
    public ?array $taches;

    function __construct(int $i, string $n, ?string $nomCrea,?array $t){
        $this->id=$i;
        $this->nom=$n;
        $this->nomCreateur=$nomCrea;
        $this->taches=$t;
    }
}

?>
<?php

class Liste {
    private int $id;
    private string $nom;
    private ?string $nomCreateur;
    private ?array $taches;

    function __construct(int $i, string $n, ?string $nomCrea,?array $t){
        $this->id=$i;
        $this->nom=$n;
        $this->nomCreateur=$nomCrea;
        $this->taches=$t;
    }

    public function get_id():int{
        return $this->id;
    }

    public function get_nom():string{
        return $this->nom;
    }

    public function get_nomCreateur():string{
        return $this->nomCreateur;
    }

    public function get_taches():?array{
        return $this->taches;
    }
}

?>
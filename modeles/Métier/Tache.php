<?php

Class Tache {
    private int $id;
    private string $intitule;
    private boolean $isCompleted;

    function __construct(int $i, string $in, boolean $is){
        $this->id = $i;
        $this->intitule = $in;
        $this->isCompleted = $is;
    }

    function get_id(): int {
        return $this->id;
    }

    function get_intitule(): string {
        return $this->intitule;
    }

    function get_isCompleted(): boolean {
        return $this->isCompleted;
    }
}

?>
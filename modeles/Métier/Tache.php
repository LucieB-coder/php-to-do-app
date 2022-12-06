<?php

Class Tache {
    private int $id;
    private string $intitule;
    private boolean $isCompleted;
    private string $description;

    function __construct(int $i, string $in, boolean $is, string $desc){
        $this->id = $i;
        $this->intitule = $in;
        $this->isCompleted = $is;
        $this->description = $desc;
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

    function get_description(): string {
        return $this->description;
    }
}

?>
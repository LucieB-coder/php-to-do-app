<?php

class VisitorModel{
    public $gw;

    public function __construct(){
        $co = new Connection();
        $this->gw = new ListeGateway($co);
    }
    
}

?>
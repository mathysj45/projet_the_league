<?php

class Equipe {
    private int $id ;
    private string $name ;
    private string $description ;
    private string $logo ;
    private $players = [];
    
    public function __construct($id ,$name, $description, $logo, $players) {
        $this->id = $id;
        $this->name = $name;    
        $this->description = $description;
        $this->logo = $logo;
        $this->players = $players;
        

    }


}

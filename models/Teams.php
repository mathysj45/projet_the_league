<?php

class Team {
    private int $id ;
    private string $name ;
    private string $description ;
    private string $logo ;
    private $players = [];
    
    public function __construct($id ,$name, $description, $logo , $players) {
        $this->id = $id;
        $this->name = $name;    
        $this->description = $description;
        $this->logo = $logo;
        $this->players = $players;
    }
    public function getId() : int {
        return $this->id ;
    }
    public function getName() : string {
        return $this->name ;
    }
    public function getDescription() : string {
        return $this->description ;
    }
    public function getLogo() : string {
        return $this->logo ;
    }
    public function getPlayers() {
        return $this->players;
    }




}

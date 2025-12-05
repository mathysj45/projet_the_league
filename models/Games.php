<?php

class Game {
    private int $id ;
    private string $name ;
    private string $date ;
    private int $team1 ;
    private int $team2 ;
    private $winner;
    
    public function __construct($id ,$name, $date, $team1 , $team2 , $winner) {
        $this->id = $id;
        $this->name = $name;    
        $this->date = $date;
        $this->team1 = $team1;
        $this->team2 = $team2;
        $this->winner = $winner;
    }
    public function getId() : int {
        return $this->id;
    }
    public function getName() : string {
        return $this->name;
    }
    public function getDate() : string {
        return $this->date;
    }
    public function getTeam1() : string {
        return $this->team1;
    }
    public function getTeam2() : string {
        return $this->team2;
    }
    public function getWinner() : int {
        return $this->winner;
    }
    
}

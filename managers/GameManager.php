<?php

class GameManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    
    }

    public function getAllGame() : array
    {
        $query = $this->db->prepare("SELECT * FROM games");
        $parameters = [

        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $games = [];

        foreach($results as $result)
        {
            $game = new Game($result["id"] ,	$result["name"] ,	$result["date"] ,	$result["team_1"] ,	$result["team_2"] ,	$result["winner"] 	);
            $games[] = $game;
        }
        return $games;
    }

    public function getTeamById(int $id) : Game
    {
        $query = $this->db->prepare("SELECT * FROM games WHERE id = :id");
        $parameters = [
            'id' => $id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result){
            
            
            $game = new Game($result["id"] ,	$result["name"] ,	$result["date"] ,	$result["team_1"] ,	$result["team_2"] ,	$result["winner"] 	);
            
            return $game;
        }else
        {
            return null;
        }
    }

}


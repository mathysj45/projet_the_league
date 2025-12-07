<?php

class GameManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    
    }

    public function getAllGames() : array
    {
        $query = $this->db->prepare("SELECT id, name, DATE(date) AS date, team_1, team_2, winner FROM games ORDER BY date DESC");
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

    public function getGameById(int $id) : Game
    {
        $query = $this->db->prepare("SELECT id, name, DATE(date) AS date, team_1, team_2, winner FROM games WHERE id = :id ORDER BY date DESC;");
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


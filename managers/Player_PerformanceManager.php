<?php

class Player_PerformanceManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    
    }

    public function getPlayerPerformanceById(int $id) 
    {
        $query = $this->db->prepare("SELECT  player, game, points, assists FROM player_performance WHERE id = :id");
        $parameters = [
            'id' => $id
        ];
        $query->execute($parameters);
        $stat = $query->fetch(PDO::FETCH_ASSOC);
        return $stat;
    }
    public function getPerformance(int $id)
    {
        $query = $this->db->prepare("SELECT  player, game, points, assists FROM player_performance");
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
}


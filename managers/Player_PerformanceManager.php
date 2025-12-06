<?php

class Player_PerformanceManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    
    }


    public function getStatsByPlayerId(int $id): array
    {
        $query = $this->db->prepare("SELECT player, game, points, assists FROM player_performance WHERE player = :id");
        $parameters = [
            'id' => $id
        ];
        $query->execute($parameters);
        
        $stats = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $stats;
    }

    public function getPerformance(int $id)
    {
        $query = $this->db->prepare("SELECT player, game, points, assists FROM player_performance");
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
}
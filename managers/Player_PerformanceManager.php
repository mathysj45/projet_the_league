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
        
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $performances = [];

        foreach ($results as $data) {
            $performance = new PlayerPerformance(
                (int)$data['player'],
                (int)$data['game'],
                (int)$data['points'],
                (int)$data['assists']
            );
            
            $performances[] = $performance;
        }
        
        return $performances;
    }
    public function getPerformance(): array
    {
        $query = $this->db->prepare("SELECT player, game, points, assists FROM player_performance");
        $query->execute();
        
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $performances = [];

        foreach ($results as $data) {
            $performances[] = new PlayerPerformance(
                (int)$data['player'],
                (int)$data['game'],
                (int)$data['points'],
                (int)$data['assists']
            );
        }
        
        return $performances;
    }
}
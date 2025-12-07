<?php

class Player_PerformanceManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getStatsByPlayerId(int $id): array
    {
        $query = $this->db->prepare("
            SELECT pp.player, pp.game, pp.points, pp.assists, g.name AS game_name 
            FROM player_performance pp
            JOIN games g ON pp.game = g.id
            WHERE pp.player = :id
        ");
        
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
                (int)$data['assists'],
                (string)$data['game_name'] 
            );
            
            $performances[] = $performance;
        }
        
        return $performances;
    }
    
}
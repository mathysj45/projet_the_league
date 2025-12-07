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
            SELECT pp.player, pp.game, pp.points, pp.assists, g.name AS game_name ,pp.game
            FROM player_performance pp
            JOIN games g ON pp.game = g.id
            WHERE pp.player = :id
            ORDER BY g.date DESC
        ");
        
        $parameters = [
            'id' => $id
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $performances = [];

        foreach ($results as $data) {
            $performances[] = new PlayerPerformance(
                $data['player'],
                $data['game'],
                $data['points'],
                $data['assists'],
                $data['game_name'] 
            );
        }
        
        return $performances;
    }

    public function getStatsByGameId(int $gameId): array
    {

        $query = $this->db->prepare("
            SELECT pp.points, pp.assists, p.nickname, t.name AS team_name
            ,pp.game FROM player_performance pp
            JOIN players p ON pp.player = p.id
            JOIN teams t ON p.team = t.id
            WHERE pp.game = :id
            ORDER BY pp.points DESC
        ");
        
        $parameters = [
            'id' => $gameId
        ];
        $query->execute($parameters);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
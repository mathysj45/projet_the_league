<?php

class Player_PerformanceManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    // On précise que la fonction retourne un tableau d'objets PlayerPerformance
    public function getStatsByPlayerId(int $id): array
    {
        $query = $this->db->prepare("SELECT player, game, points, assists FROM player_performance WHERE player = :id");
        $parameters = [
            'id' => $id
        ];
        $query->execute($parameters);
        
        // On récupère les résultats en tableau associatif
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $performances = [];

        // On boucle sur chaque résultat pour créer un objet
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

    // Tu devras faire la même logique pour getPerformance() si tu l'utilises
    // Récupère TOUTES les performances de la base de données
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
<?php

class TeamManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    
    }

    public function getAllTeam(): array
    {
        $query = $this->db->prepare("SELECT teams.id AS team_id, teams.name, teams.description, media.url AS logo
            FROM teams
            JOIN media ON teams.logo = media.id
        ");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $teams = [];

        foreach ($results as $result) {
            
            $qPlayers = $this->db->prepare("SELECT players.id, players.nickname, players.bio, media.url AS portrait , players.team
            FROM players
            JOIN media ON players.portrait = media.id
            WHERE players.team = :id");
            $qPlayers->execute(["id" => $result["team_id"]]);

            $playersData = $qPlayers->fetchAll(PDO::FETCH_ASSOC);
            $players = [];

            foreach ($playersData as $p) {

                $players[] = new Player($p["id"], $p["nickname"], $p["bio"], $p["portrait"], $p["team"]);
            }
            
            $teams[$result["team_id"]] = new Team(
                $result["team_id"],
                $result["name"],
                $result["description"],
                $result["logo"],
                $players
            );
        }

        return $teams;
    }


    public function getTeamById(int $id): ?Team
    {
        // Récupérer la team
        $query = $this->db->prepare("
            SELECT teams.id AS team_id, teams.name, teams.description, media.url AS logo
            FROM teams
            JOIN media ON teams.logo = media.id
            WHERE teams.id = :id
        ");
        $query->execute(["id" => $id]);

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        $qPlayers = $this->db->prepare("SELECT players.id , players.nickname, players.bio, media.url AS portrait , players.team
            FROM players
            JOIN media ON players.portrait = media.id
            WHERE players.team = :id");
        $qPlayers->execute(["id" => $result["team_id"]]);
        $playersData = $qPlayers->fetchAll(PDO::FETCH_ASSOC);

        $players = [];
        foreach ($playersData as $p) {
            $players[] = new Player($p["id"], $p["nickname"], $p["bio"], $p["portrait"], $p["team"]);
        }

        return new Team(
            $result["team_id"],
            $result["name"],
            $result["description"],
            $result["logo"],
            $players
        );
    }
}
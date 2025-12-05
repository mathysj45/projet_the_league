<?php

class TeamManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    
    }

    public function getAllTeam() : array
    {
        $query = $this->db->prepare('SELECT * FROM teams' );
        $parameters = [

        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $teams = [];

        foreach($results as $result)
        {
            $team = new Team($result["id"],$result["name"],$result["description"],$result["logo"]);
            $teams[] = $team;
        }
        return $teams;
    }

    public function getUserById(int $id) : User
    {
    
    }

    // ...
}


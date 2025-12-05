<?php

class TeamManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    
    }

    public function getAllTeam() : array
    {
        $query = $this->db->prepare("SELECT teams.id , teams.name, teams.description ,media.url AS logo FROM teams
                                            JOIN media on teams.logo = media.id ");
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

    public function getTeamById(int $id) : Team
    {
        $query = $this->db->prepare('SELECT teams.id , teams.name, teams.description ,media.url as logo FROM teams
                                            JOIN media on teams.logo = media.id 
                                            WHERE id = :id' );
        $parameters = [
            'id' => $id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result){
            
            
            $team = new Team($result["id"],$result["name"],$result["description"],$result["logo"]);
            
            return $team;
        }else
        {
            return null;
        }
    }

}


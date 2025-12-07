<?php

class PlayerManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    
    }

    public function getPlayerById(int $id) : Player
    {
        $query = $this->db->prepare('SELECT players.id , players.nickname,players.bio,media.url as portrait ,players.team FROM players 
                                            JOIN media on players.portrait = media.id 
                                            WHERE players.id = :id ;' );
        $parameters = [
            'id' => $id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $player = new Player($result["id"],$result["nickname"],$result["bio"],$result["portrait"], $result["team"]);
        return $player;
    }
    public function getAllPlayers() : array
    {
        $query = $this->db->prepare("SELECT players.id , players.nickname,players.bio,media.url as portrait ,players.team FROM players 
                                            JOIN media on players.portrait = media.id");
        $parameters = [

        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $players = [];

        foreach($results as $result)
        {
            $player = new Player($result["id"],$result["nickname"],$result["bio"],$result["portrait"], $result["team"]);
            $players[] = $player;
        }
        return $players;
    }


}


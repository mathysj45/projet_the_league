<?php

class PlayerManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    
    }

    public function getPlayerById(int $id) : Player
    {
        $query = $this->db->prepare('SELECT players.id , players.nickname,media.url as logo ,players.team FROM players 
                                            JOIN media on players.portrait = media.id 
                                            WHERE players.id = :id ;' );
        $parameters = [
            'id' => $id
        ];
        $query->execute($parameters);
        $player = $query->fetch(PDO::FETCH_ASSOC);
        return $player;
    }

}


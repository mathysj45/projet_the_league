<?php

class PlayerPerformance {
    private int $playerId;
    private int $gameId;
    private int $points;
    private int $assists;

    private string $gameName; 

    public function __construct(int $playerId, int $gameId, int $points, int $assists, string $gameName) {
        $this->playerId = $playerId;
        $this->gameId = $gameId;
        $this->points = $points;
        $this->assists = $assists;
        $this->gameName = $gameName;
    }

    public function getPlayerId(): int { 
        return $this->playerId; 
    }
    public function getGameId(): int { 
        return $this->gameId; 
    }
    public function getPoints(): int { 
        return $this->points; 
    }
    public function getAssists(): int { 
        return $this->assists; 
    }
    public function getGameName(): string { 
        return $this->gameName; 
    }
}
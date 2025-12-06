<?php

class PageController extends AbstractController 
{
    // --- ACCUEIL ---

    public function home() : void
    {
        $teamManager = new TeamManager();
        $playerManager = new PlayerManager();
        $gameManager = new GameManager();

        $teams = $teamManager->getAllTeam(); 
        $players = $playerManager->getAllPlayers();
        $games = $gameManager->getAllGames();
        
        $playersById = [];
        foreach ($players as $player) {
            $playersById[$player->getId()] = $player;
        }
        
        $this->render("home", [
            "pageTitle" => "The League",
            "teams" => $teams,
            "players" => $players,
            "playersById" => $playersById,
            "matches" => $games
        ]);

    }

    // --- GESTION DES ÉQUIPES ---
    public function team() : void
    {
        $teamManager = new TeamManager();

        if (isset($_GET['id'])) 
        {
            $id = (int)$_GET['id'];
            $team = $teamManager->getTeamById($id);

            $this->render("team", [
                "team" => $team,
                "pageTitle" => "Détail de la team"
            ]);
        } 
        else
        {
        $teams = $teamManager->getAllTeam();
        
        $this->render("team", [
            "teams" => $teams,
            "pageTitle" => "Les teams"
        ]);
        }
    }

    // --- GESTION DES JOUEURS ---
  public function player() : void
    {
        $playerManager = new PlayerManager();
        $perfManager = new Player_PerformanceManager();


        
        if (isset($_GET['id'])) 
        {
            $id = (int)$_GET['id'];
            $player = $playerManager->getPlayerById($id);

            if ($player) {
                 $stats = $perfManager->getStatsByPlayerId($id); 
            
            } else {
                 $stats = null;
            }

            $this->render("player", [
                "player" => $player,
                "pageTitle" => "Profil du joueur",
                "stats" => $stats 
            ]);
        } 
        else 
        {
            $players = $playerManager->getAllPlayers();
            $this->render("player", [
                "players" => $players,
                "pageTitle" => "Les players"
            ]);
        }
        
    }

    // --- GESTION DES MATCHS ---
    public function match() : void
{
    $gameManager = new GameManager();
    $perfManager = new Player_PerformanceManager();

    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        
        $game = $gameManager->getGameById($id); 
        $stats = $perfManager->getStatsByMatchId($id); 

        $this->render("match", [
            "match" => $game,
            "stats" => $stats,
            "pageTitle" => "Détails du match"
        ]);
    }
        else 
        {
            $games = $gameManager->getAllGames();
            $this->render("match", [
                "matches" => $games,
                "pageTitle" => "Les matchs"
            ]);
        }
    }

    // --- ERREUR 404 ---
    public function notFound() : void
    {
        $this->render("notFound", ["pageTitle" => "Page introuvable"]);
    }
}
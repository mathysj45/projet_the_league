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
        
        $this->render("partials/home.html.twig", [
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

            $this->render("partials/team.html.twig", [
                "team" => $team,
                "pageTitle" => "Détail de la team"
            ]);
        } 
        else
        {
        $teams = $teamManager->getAllTeam();
        
        $this->render("partials/team.html.twig", [
            "teams" => $teams,
            "pageTitle" => "Les teams"
        ]);
        }
    }

    // --- GESTION DES JOUEURS ---
  public function player() : void
    {
        $playerManager = new PlayerManager();
        $teamManager = new TeamManager();
        $gameManager = new GameManager();
        if (isset($_GET['id'])) 
        {
            $id = (int)$_GET['id'];
            $player = $playerManager->getPlayerById($id);
            
            $perfManager = new Player_PerformanceManager();
            $stats = $perfManager->getStatsByPlayerId($id);

            $teams = $teamManager->getAllTeam(); 
            $games = $gameManager->getAllGames();
            $this->render("partials/player.html.twig", [
                "player" => $player,
                "stats" => $stats,
                "teams" => $teams,
                "games" => $games,
                "pageTitle" => "Profil du joueur"
            ]);
        } 
        else 
        {
            $players = $playerManager->getAllPlayers();
            $teams = $teamManager->getAllTeam(); 

            $this->render("partials/player.html.twig", [
                "players" => $players,
                "teams" => $teams,
                "pageTitle" => "Les players"
            ]);
        }
    }

    // --- GESTION DES MATCHS ---
    public function match() : void
    {
        $gameManager = new GameManager();
        $perfManager = new Player_PerformanceManager();
        $teamManager = new TeamManager();
        
        $teams = $teamManager->getAllTeam(); 

        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            
            $game = $gameManager->getGameById($id); 
            $stats = $perfManager->getStatsByGameId($id); 

            $this->render("partials/match.html.twig", [
                "match" => $game,
                "stats" => $stats,
                "pageTitle" => "Détails du match",
                "teams" => $teams,
            ]);
        }
        else 
        {
            $games = $gameManager->getAllGames();
            $this->render("partials/match.html.twig", [
                "matches" => $games,
                "teams" => $teams,
                "pageTitle" => "Les matchs"
            ]);
        }
    }
    // --- ERREUR 404 ---
    public function notFound() : void
    {
        $this->render("partials/notFound.html.twig", ["pageTitle" => "Page introuvable"]);
    }
}
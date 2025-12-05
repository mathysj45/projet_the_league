<?php
// require_once "managers/TeamManager.php";
// require_once "managers/PlayerManager.php";
// require_once "managers/MatchManager.php";

class PageController extends AbstractController 
{
    // --- ACCUEIL ---
    public function home() : void
    {
        $teamManager = new TeamManager();
        $playerManager = new PlayerManager();
        $matchManager = new MatchManager();

        $teams = $teamManager->getAllTeam();
        $players = $playerManager->getAllPlayers();
        $matches = $matchManager->getAllMatches();

        $this->render("home", [
            "pageTitle" => "The League",
            "teams" => $teams,
            "players" => $players,
            "matches" => $matches
        ]);

    }
    // --- GESTION DES ÉQUIPES ---
    public function team() : void
    {
        $teamManager = new TeamManager();
        $teams = $teamManager->getAllTeam();
        
        $this->render("team", [
            "teams" => $teams,
            "pageTitle" => "Les teams"
        ]);
    }

    // --- GESTION DES JOUEURS ---
    public function player() : void
    {
        $playerManager = new PlayerManager();

        if (isset($_GET['id'])) 
        {
            $id = (int)$_GET['id'];
            $player = $playerManager->getPlayerById($id);

            $this->render("player", [
                "player" => $player,
                "pageTitle" => "Profil du joueur"
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
    $matchManager = new MatchManager();
    $perfManager = new Player_PerformanceManager();

    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        
        $match = $matchManager->getMatchById($id);
        $stats = $perfManager->getStatsByMatchId($id); 

        $this->render("match", [
            "match" => $match,
            "stats" => $stats,
            "pageTitle" => "Détails du match"
        ]);
    }
        else 
        {
            $matches = $matchManager->getAllMatches();
            $this->render("match", [
                "matches" => $matches,
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
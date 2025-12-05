<?php
// require_once "managers/TeamManager.php";
// require_once "managers/PlayerManager.php";
// require_once "managers/MatchManager.php";

class PageController extends AbstractController 
{
    // --- GESTION DES ÉQUIPES (Liste) ---
    public function team() : void
    {
        $teamManager = new TeamManager();
        $teams = $teamManager->getAllTeam();
        
        $this->render("team", [
            "teams" => $teams,
            "pageTitle" => "Les teams"
        ]);
    }

    // --- ACCUEIL ---
    public function home() : void
    {
        $this->render("home", ["pageTitle" => "The league"]);
    }

    // --- GESTION DES JOUEURS ---
    public function player() : void
    {
        $playerManager = new PlayerManager();

        isset($_GET['id']) 
        {
            $id = (int)$_GET['id'];
            $player = $playerManager->getPlayerById($id);

            $this->render("player", [
                "player" => $player,
                "pageTitle" => "Les players"
            ]);
        } 
    }

    // --- GESTION DES MATCHS ---
    public function match() : void
    {
        $matchManager = new MatchManager();

        isset($_GET['id']) 
        {
            $id = (int)$_GET['id'];
            $match = $matchManager->getMatchById($id);
            $matchStats = $matchManager->getStatsByMatchId($id);

            $this->render("match", [
                "match" => $match,
                "stats" => $matchStats,
                "pageTitle" => "Détails du match"
            ]);
        } 
    }

    // --- ERREUR 404 ---
    public function notFound() : void
    {
        $this->render("notFound", ["pageTitle" => "Page introuvable"]);
    }
}
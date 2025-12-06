<?php
// require_once "managers/TeamManager.php";
// require_once "managers/PlayerManager.php";
// require_once "managers/MatchManager.php";

class PageController extends AbstractController 
{
    // --- ACCUEIL ---
    // --- ACCUEIL ---
public function home() : void
{
    $teamManager = new TeamManager();
    $playerManager = new PlayerManager();
    $gameManager = new GameManager();

    // 1. Récupération des données brutes
    // (teams est supposé indexé par ID suite à la modification de TeamManager::getAllTeam())
    $teams = $teamManager->getAllTeam(); 
    $players = $playerManager->getAllPlayers();
    $games = $gameManager->getAllGames();
    
    // 2. Créer un tableau indexé pour les joueurs (utile pour les players à la une)
    $playersById = [];
    foreach ($players as $player) {
        $playersById[$player->getId()] = $player;
    }
    
    $this->render("home", [
        "pageTitle" => "The League",
        "teams" => $teams, // Indexé par ID
        "players" => $players, // Liste brute (pour boucler sur tous)
        "playersById" => $playersById, // Indexé par ID (pour l'accès direct par ID)
        "matches" => $games
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
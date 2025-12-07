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
        $teamManager = new TeamManager();

        if (isset($_GET['id'])) 
        {
            $id = (int)$_GET['id'];
            $player = $playerManager->getPlayerById($id);
            
            $perfManager = new Player_PerformanceManager();
            $stats = $perfManager->getStatsByPlayerId($id);

            $teams = $teamManager->getAllTeam(); 

            $this->render("player", [
                "player" => $player,
                "stats" => $stats,
                "teams" => $teams,
                "pageTitle" => "Profil du joueur"
            ]);
        } 
        else 
        {
            $players = $playerManager->getAllPlayers();
            $teams = $teamManager->getAllTeam(); 

            $this->render("player", [
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
        
        // Récupérer toutes les équipes une seule fois.
        // Il est plus simple de le faire ici, car elles sont nécessaires dans les deux cas (liste et détail).
        $teams = $teamManager->getAllTeam(); 

        if (isset($_GET['id'])) {
            // Logique pour l'affichage d'un seul match (détails)
            $id = (int)$_GET['id'];
            
            $game = $gameManager->getGameById($id); 
            $stats = $perfManager->getStatsByPlayerId($id); 

            $this->render("match", [
                "match" => $game,
                "stats" => $stats,
                "pageTitle" => "Détails du match",
                "teams" => $teams, // Passé ici
            ]);
        }
        else 
        {
            // Logique pour l'affichage de TOUS les matchs (liste)
            $games = $gameManager->getAllGames();
            $this->render("match", [
                "matches" => $games,
                "teams" => $teams, // C'est ici qu'il fallait le passer !
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
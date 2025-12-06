<?php

class Player {
    private int $id;
    private string $nickname;
    private string $bio;
    private  $portrait;
    private  $team;

    public function __construct(int $id, string $nickname, string $bio,  $portrait, $team) {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->bio = $bio;
        $this->portrait = $portrait;
        $this->team = $team;
    }
    public function getId(): int {
        return $this->id;
    }
    public function getNickname(): string {
        return $this->nickname;
    }
    public function getBio(): string {
        return $this->bio;
    }
    public function getPortrait() {
        return $this->portrait;
    }
    public function getTeam() {
        return $this->team;
    }
    


}
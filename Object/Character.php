<?php
require_once('GraphObject.php');
class Character extends GraphObject {
    private $xp;
    private $gameId;
    private $owner;

    public function getOwner() {
        return $this->owner;
    }
    
    public function setOwner($owner) {
        $this->owner=$owner;
    }
    
    public function getGameId() {
        return $this->gameId;
    }

    public function getXp() {
        return $this->xp;
    }

    public function setGameId($gameId) {
        $this->gameId = $gameId;
    }

    public function setXp($xp) {
        $this->xp = $xp;
    }
    
    public function toArray() {
        return array_merge(get_object_vars($this), parent::toArray());
    }
}
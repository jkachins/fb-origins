<?php 
require_once('AbstractGraphDAO.php');

class GameDAO extends AbstractGraphDAO {
  
    public function getTableName() {
        return "Game";
    }
    
    /**
     * Return Game with the given ID, or null if it does not exist.
     * @param int $id
     * @return Game or null
     */
    public function findByID($id) {
        $results = $this->select(array('GameID' => $id));
        if(!$results) { return null; }
        return $this->fillGame($results[0]);
    }
	
    //Always creates a new game entry in the DB
    //Sanitize Image URL
    public function saveOrUpdate(Game $game) {
        if(!$game->getId()) {
            return $this->insert($game->toArray());
        } else {
            return $this->update($game->toArray(), $game->getId());
        }
    }
    
    protected function fillGame(array $arr) {
        if(empty($arr)) return null;
        $game = new Game();
        $game->setDm($arr['DM']);
        $this->fillGraphObject($arr, $game);
        return $game;
    }    
}


?>
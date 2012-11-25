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
	
    /**
     * Persists a Game into the database.  If ID is set, then it will attempt to
     * update the row with that id.
     * @param Game $game
     * @return type
     */
    public function saveOrUpdate(Game $game) {
        if(!$game->getId()) {
            return $this->insert($game->toArray());
        } else {
            return $this->update($game->toArray(), $game->getId());
        }
    }

    /**
     * Turns an associative array into a Game object.
     * @param array $arr
     * @return null|\Game
     */
    protected function fillGame(array $arr) {
        if(empty($arr)) return null;
        $game = new Game();
        $game->setDm($arr['DM']);
        $this->fillGraphObject($arr, $game);
        return $game;
    }    
}


?>
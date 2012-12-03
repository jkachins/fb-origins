<?php 
require_once('AbstractGraphDAO.php');
require_once('../Object/Game.php');

class GameDAO extends AbstractGraphDAO {
  
    public function getTableName() {
        return "Game";
    }
 
    public function getGamesWithDM($id) {
        $results = $this->select(array('DM' => $id));
        return $this->fillMultipleGames($results);
    }
    
    public function getGamesPlayerIsIn($id) {
        $sql = "SELECT DISTINCT G.* FROM Game G JOIN Charact C ON G.GameID = C.GameID WHERE Owner={$id}";
        $results = $this->performJoin($sql);
        return $this->fillMultipleGames($results);
    }
    
    /**
     * Utility function to turn a result set into an array of multiple 
     * @param type $results
     * @return null|array
     */
    private function fillMultipleGames($results) {
        if(!$results) { return null; }
        $ret = array();
        foreach($results as $row) {
            array_push($ret, $this->fillGame($row));
        }
        return $ret;
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
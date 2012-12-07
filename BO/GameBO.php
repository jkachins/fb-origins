<?php
require_once '../DAO/GameDAO.php';
require_once '../FacebookWrapper.php';
/**
 * Description of GameBO
 *
 * @author jkachins
 */
class GameBO {

    public function createGame(Game $game) {
        //Validation should be done here.
        $dao = new GameDAO();
        return $dao->saveOrUpdate($game);
    }
    
    public function getGamesDMedBy($id) {
        $dao = new GameDAO();
        return $dao->getGamesWithDM($id);
    }
    
    /**
     * This may belong in CharacterBO.
     * 
     * @param int $id player fb id
     * @return array Game
     */
    public function getGamesPlayerIsIn($id) {
        $dao = new GameDAO();
        return $dao->getGamesPlayerIsIn($id);
    }
    
    public function getPlayersInGame($id) {
        $dao = new CharacterDAO();
        return $dao->findByGameID($id);
    }
    
    public function getFriendRunGames(Facebook $facebook) {
        $wrapper = new FacebookWrapper($facebook);
        $ids = $wrapper->getFriendsUsingApp();
        $dao = new GameDAO();
        return $dao->getGamesWithDM($ids);
    }
}

?>

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
    
    /**
     * Return all the characters that are playing in a given game.
     * @param int $id GameID
     * @return array Character
     */
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
    
    public function awardXP($game, $values) {
        $characters = $this->getPlayersInGame($game->getId());
        $charDAO = new CharacterDAO();
        foreach($characters as $char) {
            if(array_key_exists($char->getId(), $values)) {
                /* @var $char Character */
                $xp = $char->getXp();
                $xp += $values[$char->getId()];
                $char->setXp($xp);
                $charDAO->saveOrUpdate($char);
            }
        }
    }
}

?>

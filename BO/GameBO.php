<?php
require_once '../DAO/GameDAO.php';
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
    
    public function getGamesPlayerIsIn($id) {
        $dao = new GameDAO();
        return $dao->getGamesPlayerIsIn($id);
    }
}

?>

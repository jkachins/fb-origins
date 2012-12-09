<?php
require_once '../DAO/CharacterDAO.php';

/**
 * Description of CharacterBO
 *
 * @author jkachins
 */
class CharacterBO {
    public function getCharacter($gameId, $playerId) {
        $dao = new CharacterDAO();
        return $dao->findByGameAndPlayer($gameId, $playerId);
    }
}

?>

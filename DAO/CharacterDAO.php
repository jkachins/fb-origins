<?php
require_once('AbstractGraphDAO.php');
/**
 * Description of CharacterDAO
 *
 * @author jkachins
 */
class CharacterDAO extends AbstractGraphDAO {
    
    public function getTableName() {
        return "Charact";
    }
    
/**
     * Return Game with the given ID, or null if it does not exist.
     * @param int $id
     * @return Game or null
     */
    public function findByID($id) {
        $results = $this->select(array('GameID' => $id));
        if(!$results) { return null; }
        return $this->fillCharacter($results[0]);
    }
	
    //Always creates a new game entry in the DB
    //Sanitize Image URL
    public function saveOrUpdate(Character $character) {
        if(!$character->getId()) {
            return $this->insert($character->toArray());
        } else {
            return $this->update($character->toArray(), $character->getId());
        }
    }
    
    protected function fillCharacter(array $arr) {
        if(empty($arr)) return null;
        $character = new Character();
        $character->setXp($arr['xp']);
        $character->setOwner($arr['Owner']);
        
        $this->fillGraphObject($arr, $character);
        return $character;
    }
}

?>

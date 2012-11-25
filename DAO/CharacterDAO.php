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
     * Return Character with the given ID, or null if it does not exist.
     * @param int $id
     * @return NULL|\Character
     */
    public function findByID($id) {
        $results = $this->select(array('CharactID' => $id));
        if(!$results) { return null; }
        return $this->fillCharacter($results[0]);
    }

    public function findByGameID($id) {
        $results = $this->select(array('GameID' => $id));
        return $this->fillMultipleChar($results);
    }
    
    /**
     * Utility function to turn a result set into an array of multiple 
     * @param type $results
     * @return null|array
     */
    private function fillMultipleChar($results) {
        if(!$results) { return null; }
        $ret = array();
        foreach($results as $row) {
            array_push($ret, $this->fillCharacter($row));
        }
        return $ret;       
    }
    
    /**
     * Persists a Character into the database.  If ID is set, then it will attempt to
     * update the row with that id.
     * @param Character $character
     * @return type
     */
    public function saveOrUpdate(Character $character) {
        if(!$character->getId()) {
            return $this->insert($character->toArray());
        } else {
            return $this->update($character->toArray(), $character->getId());
        }
    }
    
    /**
     * Turns an associative array into a Character object.
     * @param array $arr
     * @return null|\Character
     */
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

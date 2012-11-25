<?php
require_once('AbstractGraphDAO.php');
/**
 * Description of CharacterDAO
 *
 * @author jkachins
 */
class ItemDAO extends AbstractGraphDAO {
    
    public function getTableName() {
        return "Item";
    }
    
/**
     * Return Game with the given ID, or null if it does not exist.
     * @param int $id
     * @return Game or null
     */
    public function findByID($id) {
        $results = $this->select(array('ItemID' => $id));
        if(!$results) { return null; }
        return $this->fillItem($results[0]);
    }
	
    //Always creates a new game entry in the DB
    //Sanitize Image URL
    public function saveOrUpdate(Item $item) {
        if(!$item->getId()) {
            return $this->insert($item->toArray());
        } else {
            return $this->update($item->toArray(), $item->getId());
        }
    }
    
    protected function fillItem(array $arr) {
        if(empty($arr)) return null;
        $item = new Item();
        $item->setQuantity($arr['Quantity']);
        $item->setOwnerId($arr['OwnerID']);
        
        $this->fillGraphObject($arr, $item);
        return $item;
    }
}

?>

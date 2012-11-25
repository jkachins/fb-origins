<?php
require_once('AbstractGraphDAO.php');
/**
 * Description of ItemDAO
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
	
    /**
     * Persists a Item into the database.  If ID is set, then it will attempt to
     * update the row with that id.
     * @param Item $item
     * @return type
     */
    public function saveOrUpdate(Item $item) {
        if(!$item->getId()) {
            return $this->insert($item->toArray());
        } else {
            return $this->update($item->toArray(), $item->getId());
        }
    }
    
    /**
     * Turns an associative array into an Item object.
     * @param array $arr
     * @return null|\Item
     */
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

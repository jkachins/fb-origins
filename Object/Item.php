<?php 
require_once 'GraphObject.php';
class Item extends GraphObject {
    private $ownerId;
    private $quantity;

    public function toArray() {
        return array_merge(get_object_vars($this), parent::toArray());
    }
    
    public function getOwnerId() {
        return $this->ownerId;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setOwnerId($ownerId) {
        $this->ownerId = $ownerId;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }
}
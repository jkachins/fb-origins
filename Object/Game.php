<?php 
require_once('GraphObject.php');
class Game extends GraphObject {
	private $dm;
	
	public function getDm() {
		return $this->dm;
	}
	
	public function setDm($dm) {
		$this->dm = $dm;
	}
        
        public function toArray() {
            return array_merge(get_object_vars($this), parent::toArray());
        }
}
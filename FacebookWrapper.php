<?php
require_once 'sdk/src/facebook.php';

class FacebookWrapper {
   private $facebook;
   public function __construct($facebook) {
       $this->facebook = $facebook;
   }
   
   public function postToGroup($id, $message) {
        return $this->facebook->api("/{$id}/feed", "POST",
                array('message'=>$message));
    }
    
    public function getFriendsUsingApp() {
        $results = $this->facebook->api(array(
            'method' => 'fql.query',
            'query' => 'SELECT uid, name FROM user WHERE uid IN(SELECT uid2 FROM friend WHERE uid1 = me()) AND is_app_user = 1'
        ));

        if(empty($results)) {
            return array();
        }
        
        $return = array();
        foreach($results as $friend) {
            array_push($return, $friend['uid']);
        }
        return $return;
    }
}

?>

<?php
require_once 'AbstractHttpController.php';
require_once '../sdk/src/facebook.php';

/**
 * Description of invitationController
 *
 * @author jkachins
 */
class invitationHttpController extends AbstractHttpController {
    public function __construct() {
        parent::__construct();
    }
    
    private function fullRequestId($userId, $requestId) {
        return "{$requestId}_{$userId}";
    }
    
    public function invitations() {
        if(!isset($_REQUEST['request_ids'])) {
            echo 'get out';
            exit();
        }
       
        $user = $this->facebook->getUser();
        echo $user;
        $request_ids = explode(',', $_REQUEST['request_ids']);
        foreach($request_ids as $request_id) {
            $fullRequestId = $this->fullRequestId($user, $request_id);
            $request = $this->facebook->api("/{$fullRequestId}");
            print_r($request);
            echo '<br/>';
        }
        
    }
}

?>

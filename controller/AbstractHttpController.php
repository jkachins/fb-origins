<?php
require_once '../AppInfo.php';
require_once '../sdk/src/facebook.php';
require_once '../cache/Cache.php';
/**
 * This should be used to set up the facebook and cache for other controllers
 *
 * @author jkachins
 */
class AbstractHttpController {
    /**
     * Interaction between FB and BotF
     * @var Facebook
     */
    protected $facebook;
    protected $cache;
    
    public function __construct() {
        $this->facebook = new Facebook(array(
            'appId'  => AppInfo::appID(),
            'secret' => AppInfo::appSecret(),
            'sharedSession' => true,
            'trustForwarded' => true,
        ));
        $this->cache = new Cache();

        $user = $this->facebook->getUser();
        $access_token = $this->facebook->getAccessToken();
        
        if(!$user) {
            header('Location: http://'. $_SERVER['HTTP_HOST']);
            exit();
        } else {
            $token = $this->cache->get($user);
            if($token) {
                $this->facebook->setAccessToken($token);
            } else if($access_token != AppInfo::appToken()) {
                $this->cache->put($user, $access_token);
            }
        }
    }
}

?>

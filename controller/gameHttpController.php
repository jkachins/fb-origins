<?php

/**
 * Description of gameHttpController
 *
 * @author jkachins
 */

require_once ('../sdk/src/facebook.php');
require_once('../AppInfo.php');

class gameHttpController {
    
    private $facebook;
    
    public function __construct() {
        $this->facebook = new Facebook(array(
  'appId'  => AppInfo::appID(),
  'secret' => AppInfo::appSecret(),
  'sharedSession' => true,
  'trustForwarded' => true,
));
    }
    
    public function createGame() {
        $game = new Game();
        $game->setTitle($_REQUEST['title']);
        $game->setDescription($_REQUEST['description']);
    }
    
    public function gameLobby() {
        $gameBO = new GameBO();
        $user = $this->facebook->getUser();
        //assuming a user exists is a bad idea.
        $owned = $gameBO->getGamesDMedBy($user);
        $played = $gameBO->getGamesPlayerIsIn($user);
        $model = array();
        $model['ownedGames'] = $owned;
        $model['playedGames'] = $played;
        return $model;
    }
}

?>

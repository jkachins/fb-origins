<?php

/**
 * Description of gameHttpController
 *
 * @author jkachins
 */

require_once '../sdk/src/facebook.php';
require_once '../AppInfo.php';
require_once '../Object/Game.php';
require_once '../DAO/GameDAO.php';
require_once '../DAO/CharacterDAO.php';
require_once '../BO/GameBO.php';
require_once '../cache/Cache.php';

class gameHttpController {
    
    private $facebook;
    private $cache;
    
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
    
    public function createGame() {
        
    }
    
    private function createAwardsArray() {
        $values = array();
        foreach($_REQUEST as $key=>$value) {
            if(substr($key,0,5) == "char_") {
                $values[substr($key,5)] = $value;
            }
        }
        return $values;
    }

    private function runUpdates($game) {
        $awards = $this->createAwardsArray();
        $gameBO = new GameBO();
        $gameBO->awardXP($game, $awards);
    }
    
    public function viewGame() {
        if(!isset($_REQUEST['id'])) {
            //Crap error handling
            return array();
        }
        $id = $_REQUEST['id'];
        $gameDAO = new GameDAO();
        $charDAO = new CharacterDAO();
        $game = $gameDAO->findByID($id);
        
        if(isset($_REQUEST['submit'])) {
            $this->runUpdates($game);
        }
        
        /* @var $game Game */
        $model = array('game' => $game);
        
        $gameDm = $game->getDm();
        $userId = $this->facebook->getUser();
        
        if($userId==$gameDm) {
            $model['dm']=true;
            $gameBO = new GameBO();
            $model['characters'] = $gameBO->getPlayersInGame($id);
        } else {
            $char = $charDAO->findByGameAndPlayer($id, $userId);
            $model['my_char'] = $char;
        }
        
        return $model;
    }
    
    public function registerGame() {
        $uid = $this->facebook->getUser();
        $game = new Game();
        
        //ANY Sort of error handling
        //After considering error handling, this logic
        //will move to some other service layer
        
        $game->setDm($uid);
        $game->setDescription($_REQUEST['description']);
        $game->setTitle($_REQUEST['title']);
        $game->setImage($_REQUEST['image']);
        $gameDAO = new GameDAO();
        $gameDAO->saveOrUpdate($game);
        
        $model = array();
        $model['game'] = $game;
        return $model;
    }
    
    public function gameLobby() {
        $gameBO = new GameBO();
        $user = $this->facebook->getUser();
        
        //assuming a user exists is a bad idea.
        $owned = $gameBO->getGamesDMedBy($user);
        $played = $gameBO->getGamesPlayerIsIn($user);
        $friends = $gameBO->getFriendRunGames($this->facebook);

        $model = array();
        $model['ownedGames'] = $owned;
        $model['playedGames'] = $played;
        if(!empty($friends)) {
            $model['friendsGames'] = array_diff($friends, $played);
        }
        return $model;
    }
    
    public function postToGroup() {
        $message = $_REQUEST['message'];
        $gameid = $_REQUEST['gameid'];
        $model = array();
        $model['result'] = 
        $this->facebook->api("/182170928514884/feed", 'POST',
                array('message'=>"Test Post from App"));
        return $model;
    }
}

?>

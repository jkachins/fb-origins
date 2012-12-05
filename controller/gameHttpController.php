<?php

/**
 * Description of gameHttpController
 *
 * @author jkachins
 */

require_once ('../sdk/src/facebook.php');
require_once('../AppInfo.php');
require_once '../Object/Game.php';
require_once '../DAO/GameDAO.php';
require_once '../DAO/CharacterDAO.php';
require_once '../BO/GameBO.php';

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
        
    }
    
    public function viewGame() {
        if(!isset($_REQUEST['id'])) {
            //Crap error handling
            return array();
        }
        $id = $_REQUEST['id'];
        $gameDAO = new GameDAO();
        $game = $gameDAO->findByID($id);
        
        //Needs Error Handling!
        if(!$game) {
            //Shunt off to error page?
        }
        
        /* @var $game Game */
        $model = array('game' => $game);
        
        $gameDm = $game->getDm();
        $userId = $this->facebook->getUser();
        
        if($userId==$gameDm) {
            $model['dm']=true;
            $gameBO = new GameBO();
            $model['characters'] = $gameBO->getPlayersInGame($id);
        }
        
        return $model;
    }
    
    public function registerGame() {
        $uid = $this->facebook->getUser();
        $game = new Game();
        
        //ANY Sort of error handling
        
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
        $model = array();
        $model['ownedGames'] = $owned;
        $model['playedGames'] = $played;
        
        return $model;
    }
}

?>

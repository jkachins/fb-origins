<?php
require_once '../checkLogin.php';
require_once '../controller/gameHttpController.php';

$controller = new gameHttpController();
$model = $controller->registerGame();
$game = $model['game'];

if($game->getId()) {
    header('Location: https://'. 
            $_SERVER['HTTP_HOST'] . 
            '/origins/game?id='.
            $game->getId());
} else  {
    header('Location: https://'. 
            $_SERVER['HTTP_HOST'] . 
            '/error.php');
}

?>


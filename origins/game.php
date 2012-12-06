<?php

require_once '../checkLogin.php';
require_once '../controller/gameHttpController.php';

$controller = new gameHttpController();
$model = $controller->viewGame();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Game</title>
        <?php include '../fragments/headerInfo.php'?>
    </head>
    <body>
        <h1>Game</h1>
        <a href="gameLobby.php">Back to Lobby</a>
        <h2>Game Info</h2>
        <p>
            <?= $model['game']->getTitle() ?>
        </p>
        <p>
            <?= $model['game']->getDescription() ?>
        </p>
        
        <?php if(isset($model['dm'])) { ?>
            <h2>DM Options</h2>
            <?php 
                if(isset($model['characters'])) {
                    foreach ($model['characters'] as $character) { 
                    /* @var $character Character */ ?>
                    <?php echo "{$character->getTitle()} : {$character->getXp()}" ?>
                    <br/>
            <?php } }?>
        <?php } ?>
    </body>
</html>
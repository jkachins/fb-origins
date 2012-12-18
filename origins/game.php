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
        <script type="text/javascript" src="/javascript/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="/javascript/game.js"></script>
        <script type="text/javascript" src="/javascript/FacebookInit.php"></script>
        <?php include '../fragments/headerInfo.php'?>
    </head>
    <body>
        <h1>Game</h1>
        <a href="gameLobby.php">Back to Lobby</a>
        <h2>Game Info</h2>
        <div id="fb-root"></div>
        <p>
            <?= $model['game']->getTitle() ?>
        </p>
        <p>
            <?= $model['game']->getDescription() ?>
        </p>
        <div>
            Run by <br/>
            <a target="_top" href="https://facebook.com/<?= $model['game']->getDm(); ?>">
                <?php writeImage($model['game']->getDm()); ?>
            </a>
        </div>
        
        <form id="form">
            <input type="hidden" name="id" value="<?= $model['game']->getId() ?>"/>
            <?php if(isset($model['dm'])) { ?>
                <h2>DM Options</h2>
                
                <a href="#" class="facebook-button apprequests" id="sendRequest" data-data="<?= $model['game']->getId(); ?>" data-message="Join this game I'm running!" onclick="sendRequest();">
                    <span class="apprequests">Send Requests</span>
                </a>
                
                <table>
                    <tr><th>Character</th><th>XP</th><th>Give XP</th></tr>
                <?php 
                    if(isset($model['characters'])) {
                        foreach ($model['characters'] as $character) { 
                        /* @var $character Character */ ?>
                        <tr>
                            <td><?= $character->getTitle();?></td>
                            <td><?=$character->getXp();?></td>
                            <td><input type="text" name="char_<?= $character->getId(); ?>"
                                      id="char_<?= $character->getId(); ?>"/></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </table>
                <input type="submit" name="submit" value="award"/>
            <?php } ?>

            <?php if(isset($model['my_char'])) { $char=$model['my_char']; ?>
                <h2>My Character</h2>
                <p>Name: <?= $char->getTitle(); ?></p>
                <p>XP: <?= $char->getXp(); ?></p>
            <?php } ?>
        </form>

    </body>
</html>
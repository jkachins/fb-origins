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
        <script type="text/javascript" src="/javascript/game.js"></script>
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
            <a href="https://facebook.com/<?= $model['game']->getDm(); ?>">
                <?php writeImage($model['game']->getDm()); ?>
            </a>
        </div>
        
        <form id="form">
            <input type="hidden" name="id" value="<?= $model['game']->getId() ?>"/>
            <?php if(isset($model['dm'])) { ?>
                <h2>DM Options</h2>
                <?php 
                    if(isset($model['characters'])) {
                        foreach ($model['characters'] as $character) { 
                        /* @var $character Character */ ?>
                        <p><?= $character->getTitle();?> : <?=$character->getXp();?>
                           <input type="text" name="char_<?= $character->getId(); ?>"
                                  id="char_<?= $character->getId(); ?>"/>
                        </p>
                    <?php } ?>
                <?php } ?>
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
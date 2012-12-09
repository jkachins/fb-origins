<?php
require_once '../controller/gameHttpController.php';
require_once '../BO/GameBO.php';
require_once '../utils.php';

$controller = new gameHttpController();
$model = $controller->gameLobby();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Game Lobby</title>
        <?php include '../fragments/headerInfo.php'; ?>
    </head>
    <body>
        <div id="fb-root"></div>
        <?php include '../fragments/facebook-sdk.php'; ?>
        <h1>Game Lobby</h1>
        <p>
            <a href="createGame.php">Create Game</a><br/>
        </p>

        <h2>Games you are running</h2>
        <?php if(empty($model['ownedGames'])) { ?>
        <p> Create a game! </p>
        <?php } else {
            foreach($model['ownedGames'] as $game) {
                /* @var $game Game */
                ?>
        <p>
        <Strong>
            <a href="game.php?id=<?= $game->getId() ?>" title="<?= substr($game->getDescription(), 0, 100) ?> <?php if(strlen($game->getDescription()) > 100) { echo '. . .'; } ?>">
            <?= $game->getTitle(); ?>:
            </a>
        </Strong>
        </p>
        <?php }
        } ?>
        
        <?php if(!empty($model['playedGames'])) { ?>
            <h2>Games you are playing</h2>
            <?php foreach($model['playedGames'] as $game) { ?>
                <p> Playing in 
                <a href="game.php?id=<?= $game->getId() ?>" title="<?= substr($game->getDescription(), 0, 100) ?> <?php if(strlen($game->getDescription()) > 100) { echo '. . .'; } ?>">
                <?= $game->getTitle() ?>
                </a>
                </p>
                <p class="thumbnail75" <?php writePicture($game->getDm());?> >
                </p>      
            <?php } ?>
        <?php } ?>
                
        <?php if(!empty($model['friendsGames'])) { ?>
            <h2>Games your friends are running</h2>
            <?php foreach($model['friendsGames'] as $game) { ?>
                <p> Playing in <?= $game->getTitle() ?> </p>
                <p class="thumbnail75" <?php writePicture($game->getDm());?> >
                </p>      
            <?php } ?>
        <?php } ?>
                
    </body>
</html>
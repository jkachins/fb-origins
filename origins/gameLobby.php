<?php
require_once '../initializeResources.php';
require_once '../controller/gameHttpController.php';
require_once '../BO/GameBO.php';

require_once('../checkLogin.php');
$controller = new gameHttpController();
$model = $controller->gameLobby();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" />

        <title>Game Lobby</title>
        <link rel="stylesheet" href="stylesheets/screen.css" media="Screen" type="text/css" />
        <link rel="stylesheet" href="stylesheets/mobile.css" media="handheld, only screen and (max-width: 480px), only screen and (max-device-width: 480px)" type="text/css" />
        <title>Game Lobby</title>
    </head>
    <body>
        <h1>Game Lobby</h1>
        <p>
            <a href="createGame.php">Create Game</a>
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
            <a href="game.php?id=<?= $game->getId() ?>">
            <?= $game->getTitle(); ?>:
            </a>
        </Strong>
        </p>
        <?php }
        } ?>
        <?php if(!empty($model['playedGames'])) { ?>
            <h2>Games you are playing</h2>
            <?php foreach($model['playedGames'] as $game) { ?>
                <p> Playing in <?= $game->getTitle() ?> </p>
                <p style="background-image: url(https://graph.facebook.com/<?php echo $game->getDm() ?>/picture?type=normal); width:75px; height:75px;"></p>      
            <?php } ?>
        <?php } ?>
    </body>
</html>
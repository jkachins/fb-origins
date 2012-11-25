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
    </head>
    <body>
    <p>This is where the create button will be</p>

    <?php if(empty($model['games'])) { ?>
    <p> Create a game! </p>
    <?php } else {
        foreach($model['games'] as $game) {
            /* @var $game Game */
            ?>
    <p>
    <Strong><?= $game->getTitle(); ?>:</Strong>
     run by (<?= $game->getDm() ?>). </p>
    <?php }
    } ?>
    </body>
</html>
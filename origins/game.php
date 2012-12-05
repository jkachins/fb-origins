<?php

require_once '../checkLogin.php';
require_once '../controller/gameHttpController.php';

$controller = new gameHttpController();
$model = $controller->viewGame();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Game</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" />

        <link rel="stylesheet" href="stylesheets/screen.css" media="Screen" type="text/css" />
        <link rel="stylesheet" href="stylesheets/mobile.css" media="handheld, only screen and (max-width: 480px), only screen and (max-device-width: 480px)" type="text/css" />
    </head>
    <body>
        <h1>Game</h1>
        <a href="gameLobby.php">Back to Lobby</a>
        <h2>Game Info</h2>
        <p>
            <?= $model['game']->getTitle() ?>
        </p>
        <?php if(isset($model['dm'])) { ?>
        <h2>DM Options</h2>
        <?php } ?>
    </body>
</html>
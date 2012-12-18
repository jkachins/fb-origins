<?php
require_once '../controller/gameHttpController.php';

require_once '../checkLogin.php';

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Create Game</title>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" />
        <link rel="stylesheet" href="stylesheets/screen.css" media="Screen" type="text/css" />
        <link rel="stylesheet" href="stylesheets/mobile.css" media="handheld, only screen and (max-width: 480px), only screen and (max-device-width: 480px)" type="text/css" />
        <link rel="stylesheet" href="stylesheets/general.css" media="Screen" type="text/css" />
    </head>
    <body>
        <a href="gameLobby.php">Back to Lobby</a>
        <h1>Create Game</h1>
        
        <form action="registerGame.php" method="GET">
            <table>
                <tr>
                    <td>
                        <label for="title">Game Name:</label>
                    </td>
                    <td>
                        <input id="title" type="text" name="title"/><br/>
                    </td>
                </tr>
                    <!--            <label for="image">Image URL:</label>
                    <input id="image" type="text" name="image"/><br/> -->
                <tr>
                    <td>
                        <label for="description">Description: </label>
                    </td>
                    <td>
                        <textarea name="description" id="description"></textarea><br/>
                    </td>
                </tr>
            </table>
            <input type="submit" name="submit" value="Create Game"/>
            </table>
        </form>
    </body>
</html>
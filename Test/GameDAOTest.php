<?php


require_once($_SERVER['DOCUMENT_ROOT'] . '/DAO/GameDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Object/Game.php');

function saveTest() {
    $game = new Game();

    $game->setTitle('test title');
    $game->setDescription('test game description');
    $game->setDM('1');
    $game->setImage('http://botfapp.local/images/fpo-picture.gif');

    $gameDAO = new GameDAO();
    
    if($gameDAO->saveOrUpdate($game)) {
        echo '<span class="pass">Save successful</span><br/>';
    } else {
        echo '<span class="fail">Failed to Save</span><br/>';
        AbstractBaseDAO::showWarnings();
    }
}

function updateTest() {
    $game = new Game();
    $gameDAO = new GameDAO();

    $game->setTitle('test update');
    $game->setDescription('update game description');
    $game->setDM('2');
    $game->setImage('http://botfapp.local/images/fpo-picture2.gif');
    $game->setId(1);
    if($gameDAO->saveOrUpdate($game)) {
        echo 'pass';
    } else {
        echo 'fail: ' . AbstractBaseDAO::showWarnings();
    }
    
}

function loadTest() {
    $gameDAO = new GameDAO();
    $game = $gameDAO->findByID(1);
    if(!$game) {
        echo '<span class="fail">Could Not Find Entry</span>';
    } else {
        echo '<span class="pass">Entry Found</span>';
    }
}
?>

<html>      
    <head>
        <style>
            .fail {color: red;}
            .pass {color: green; }
        </style>
    </head>
    <body>
        <?php if(isset($_GET['save'])) {  ?>
        <p>Test D A O Save: <?php saveTest(); } ?></p>
        <?php if(isset($_GET['load'])) { ?>
        <p>Test D A O Load: <?php loadTest(); } ?> </p>    
        <?php if(isset($_GET['update'])) { ?>
        <p>Test D A O Update: <?php updateTest(); } ?> </p>    
        
    </body>
</html>
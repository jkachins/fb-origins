<?php


require_once($_SERVER['DOCUMENT_ROOT'] . '/DAO/CharacterDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Object/Character.php');

function saveTest() {
    $character = new Character();

    $character->setTitle('test title');
    $character->setDescription('test game description');
    $character->setImage('http://botfapp.local/images/fpo-picture.gif');
    $character->setGameId(1);
    $character->setXp(200);
    
    $DAO = new CharacterDAO();
    
    if($DAO->saveOrUpdate($character)) {
        echo '<span class="pass">Save successful</span><br/>';
    } else {
        echo '<span class="fail">Failed to Save</span><br/>';
        AbstractBaseDAO::showWarnings();
    }
}

function updateTest() {
    $char = new Character();
    $DAO = new CharacterDAO();

    $char->setTitle('test update');
    $char->setDescription('update game description');
    $char->setImage('http://botfapp.local/images/fpo-picture2.gif');
    $char->setId(1);
    $char->setXp(333);
    $char->setGameId(1);
    if($DAO->saveOrUpdate($char)) {
        echo 'pass';
    } else {
        echo 'fail: ' . AbstractBaseDAO::showWarnings();
    }
    
}

function loadTest() {
    $DAO = new CharacterDAO();
    $char = $DAO->findByID(1);
    if(!$char) {
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
<?php


require_once($_SERVER['DOCUMENT_ROOT'] . '/DAO/ItemDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Object/Item.php');

function saveTest() {
    $item = new Item();

    $item->setTitle('test title');
    $item->setDescription('test game description');
    $item->setImage('http://botfapp.local/images/fpo-picture.gif');
    $item->setOwnerId(1);
    $item->setQuantity(200);
    
    $DAO = new ItemDAO();
    
    if($DAO->saveOrUpdate($item)) {
        echo '<span class="pass">Save successful</span><br/>';
    } else {
        echo '<span class="fail">Failed to Save</span><br/>';
        AbstractBaseDAO::showWarnings();
    }
}

function updateTest() {
    $item = new Item();
    $DAO = new ItemDAO();

    $item->setTitle('test update');
    $item->setDescription('update game description');
    $item->setImage('http://botfapp.local/images/fpo-picture2.gif');
    $item->setId(1);
    $item->setQuantity(333);
    $item->setOwnerId(1);
    if($DAO->saveOrUpdate($item)) {
        echo 'pass';
    } else {
        echo 'fail: ' . AbstractBaseDAO::showWarnings();
    }
    
}

function loadTest() {
    $DAO = new ItemDAO();
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
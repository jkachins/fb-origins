<?php

require_once '../checkLogin.php';
require_once '../controller/gameHttpController.php';

$controller = new gameHttpController();
$model = $controller->postToGroup();

echo var_dump($model['result']);

?>

<?php
require_once '../cache/Cache.php';

$cache = new Cache();

$key = "KEY";
$value = "VALUE";

$cache->put($key, $value, 5);
$ret = $cache->get($key);

sleep(7);

$ret_sleep = $cache->get($key);


$passed1 = $ret == $value;
$passed2 = !isset($ret_sleep);
?>

<p> Test PUT/GET: <?= $passed1 ?></p>
<p> Test Expiration: <?= $passed2 ?></p>

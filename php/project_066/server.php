<?php
function add($a, $b) { return $a + $b; }
$options = ['uri'=>'http://localhost/server.php'];
$server = new SoapServer(null, $options);
$server->addFunction('add');
$server->handle();

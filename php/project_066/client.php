<?php
$options = ['location'=>'http://localhost/server.php','uri'=>'http://localhost/server.php'];
$client = new SoapClient(null, $options);
echo $client->add(2,3);

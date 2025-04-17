<?php
require_once __DIR__.'/vendor/autoload.php';
use App\Greeter;
$greeter = new Greeter();
echo $greeter->greet('World');

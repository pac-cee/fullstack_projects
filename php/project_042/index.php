<?php
$cacheFile = 'cache.json';
$cacheTime = 60; // seconds
if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $cacheTime) {
    $data = file_get_contents($cacheFile);
    echo "Loaded from cache:<br>" . $data;
} else {
    $json = file_get_contents('https://jsonplaceholder.typicode.com/todos/1');
    file_put_contents($cacheFile, $json);
    echo "Fetched new:<br>" . $json;
}

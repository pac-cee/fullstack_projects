<?php
$dir = __DIR__ . '/images';
if (!is_dir($dir)) mkdir($dir);
$imgs = array_filter(scandir($dir), function($f){return preg_match('/\.(jpe?g|png|gif)$/i', $f);});
?><!DOCTYPE html><html><body>
<h1>Image Gallery</h1>
<?php foreach($imgs as $img): ?>
<img src="images/<?=urlencode($img)?>" style="max-width:120px; margin:5px;">
<?php endforeach; ?>
</body></html>

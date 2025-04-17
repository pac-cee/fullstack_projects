<?php
$uploads = __DIR__.'/uploads';
$thumbs = __DIR__.'/thumbs';
if (!is_dir($uploads)) mkdir($uploads);
if (!is_dir($thumbs)) mkdir($thumbs);
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_FILES['img'])) {
    $file = $_FILES['img'];
    $target = $uploads.'/'.basename($file['name']);
    if (move_uploaded_file($file['tmp_name'], $target)) {
        // Make thumbnail
        $src = imagecreatefromjpeg($target);
        $w = imagesx($src); $h = imagesy($src);
        $tw = 100; $th = 100;
        $thumb = imagecreatetruecolor($tw, $th);
        imagecopyresampled($thumb, $src, 0,0,0,0, $tw, $th, $w, $h);
        imagejpeg($thumb, $thumbs.'/'.basename($file['name']));
        imagedestroy($src); imagedestroy($thumb);
    }
}
?><form method="post" enctype="multipart/form-data">
<input type="file" name="img" accept="image/jpeg">
<button>Upload</button>
</form>
<hr>
<h2>Thumbnails</h2>
<?php foreach(array_filter(scandir($thumbs),function($f){return $f[0]!=='.';}) as $img): ?>
<img src="thumbs/<?=urlencode($img)?>">
<?php endforeach; ?>

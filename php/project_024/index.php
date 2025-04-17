<?php
$uploadsDir = __DIR__ . '/uploads';
if (!is_dir($uploadsDir)) mkdir($uploadsDir);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];
    if ($file['error'] === UPLOAD_ERR_OK && strpos($file['type'], 'image/') === 0) {
        $target = $uploadsDir . '/' . basename($file['name']);
        move_uploaded_file($file['tmp_name'], $target);
    }
}
$images = array_filter(scandir($uploadsDir), function($f){return preg_match('/\.(jpe?g|png|gif)$/i', $f);});
?><!DOCTYPE html>
<html><body>
<h1>Image Upload</h1>
<form method="post" enctype="multipart/form-data">
<input type="file" name="image" accept="image/*">
<button type="submit">Upload</button>
</form>
<hr>
<?php foreach($images as $img): ?>
<img src="uploads/<?=urlencode($img)?>" style="max-width:150px; margin:5px;">
<?php endforeach; ?>
</body></html>

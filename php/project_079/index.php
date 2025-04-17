<?php
$dir = __DIR__.'/uploads';
if (!is_dir($dir)) mkdir($dir);
if (isset($_FILES['file'])) {
    $name = basename($_FILES['file']['name']);
    $ver = 1;
    while (file_exists("$dir/{$name}_v$ver")) $ver++;
    move_uploaded_file($_FILES['file']['tmp_name'], "$dir/{$name}_v$ver");
}
$files = glob("$dir/*");
?><form method="post" enctype="multipart/form-data">
<input type="file" name="file"><button>Upload</button>
</form>
<h3>Files</h3>
<ul>
<?php foreach($files as $f): ?>
<li><?=basename($f)?></li>
<?php endforeach; ?>
</ul>

<?php
$dir = __DIR__ . '/files';
if (!is_dir($dir)) mkdir($dir);
$msg = '';
if (isset($_POST['create']) && $_POST['fname']) {
    file_put_contents("$dir/".$_POST['fname'], '');
    $msg = 'File created!';
}
if (isset($_POST['delete']) && $_POST['fname']) {
    unlink("$dir/".$_POST['fname']);
    $msg = 'File deleted!';
}
$files = array_filter(scandir($dir), function($f){return $f[0]!=='.';});
?><form method="post">
<input name="fname" placeholder="Filename">
<button name="create">Create</button>
<button name="delete">Delete</button>
</form>
<?php if($msg) echo $msg; ?>
<ul>
<?php foreach($files as $f): ?>
<li><?=htmlspecialchars($f)?></li>
<?php endforeach; ?>
</ul>

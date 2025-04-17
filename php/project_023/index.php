<?php
// Mini-blog: posts stored as files in posts/
$postsDir = __DIR__ . '/posts';
if (!is_dir($postsDir)) mkdir($postsDir);
$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? '';
if ($action === 'delete' && $id && file_exists("$postsDir/$id.txt")) {
    unlink("$postsDir/$id.txt");
    header('Location: index.php'); exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $body = trim($_POST['body'] ?? '');
    if ($title && $body) {
        $filename = preg_replace('/[^a-zA-Z0-9_-]/', '_', $title);
        file_put_contents("$postsDir/$filename.txt", $body);
    }
    header('Location: index.php'); exit;
}
$posts = array_filter(scandir($postsDir), function($f){return substr($f, -4)==='.txt';});
?><!DOCTYPE html>
<html><body>
<h1>Mini Blog</h1>
<form method="post">
Title: <input name="title"> <br>
Body: <br><textarea name="body"></textarea><br>
<button type="submit">Post</button>
</form>
<hr>
<h2>Posts</h2>
<ul>
<?php foreach($posts as $post): $t=basename($post, '.txt'); ?>
<li><b><?=htmlspecialchars($t)?></b> - <a href="?action=delete&id=<?=urlencode($t)">Delete</a><br>
<pre><?=htmlspecialchars(file_get_contents("$postsDir/$post"))?></pre></li>
<?php endforeach; ?>
</ul>
</body></html>

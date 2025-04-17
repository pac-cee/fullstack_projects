<?php
// Simple Blog Engine
$db = new PDO('sqlite:blog.db');
$db->exec('CREATE TABLE IF NOT EXISTS posts (id INTEGER PRIMARY KEY, title TEXT, body TEXT)');
$db->exec('CREATE TABLE IF NOT EXISTS comments (id INTEGER PRIMARY KEY, post_id INTEGER, text TEXT)');
if (isset($_POST['title'], $_POST['body'])) {
    $db->prepare('INSERT INTO posts (title, body) VALUES (?,?)')->execute([$_POST['title'], $_POST['body']]);
}
if (isset($_POST['comment'], $_POST['post_id'])) {
    $db->prepare('INSERT INTO comments (post_id, text) VALUES (?,?)')->execute([$_POST['post_id'], $_POST['comment']]);
}
$posts = $db->query('SELECT * FROM posts')->fetchAll();
?><form method="post">
<input name="title" placeholder="Title"><br>
<textarea name="body" placeholder="Body"></textarea><br>
<button>Add Post</button>
</form>
<?php foreach($posts as $p): ?>
<h2><?=htmlspecialchars($p['title'])?></h2>
<p><?=nl2br(htmlspecialchars($p['body']))?></p>
<form method="post">
<input type="hidden" name="post_id" value="<?=$p['id']?>">
<input name="comment" placeholder="Add comment"><button>Comment</button>
</form>
<ul>
<?php foreach($db->query('SELECT * FROM comments WHERE post_id='.$p['id']) as $c): ?>
<li><?=htmlspecialchars($c['text'])?></li>
<?php endforeach; ?>
</ul>
<?php endforeach; ?>

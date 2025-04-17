<?php
$db = new PDO('sqlite:tasks.db');
$db->exec("CREATE TABLE IF NOT EXISTS tasks (id INTEGER PRIMARY KEY, name TEXT)");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add']) && $_POST['task']) {
        $stmt = $db->prepare('INSERT INTO tasks (name) VALUES (?)');
        $stmt->execute([$_POST['task']]);
    }
    if (isset($_POST['delete']) && $_POST['id']) {
        $stmt = $db->prepare('DELETE FROM tasks WHERE id=?');
        $stmt->execute([$_POST['id']]);
    }
}
$tasks = $db->query('SELECT * FROM tasks')->fetchAll(PDO::FETCH_ASSOC);
?><!DOCTYPE html><html><body>
<h1>Tasks</h1>
<form method="post">
<input name="task"><button name="add">Add</button>
</form>
<ul>
<?php foreach($tasks as $t): ?>
<li><?=htmlspecialchars($t['name'])?> <form style="display:inline" method="post"><input type="hidden" name="id" value="<?=$t['id']?>"><button name="delete">Delete</button></form></li>
<?php endforeach; ?>
</ul>
</body></html>

<?php
$db = new PDO('sqlite:search.db');
$db->exec("CREATE TABLE IF NOT EXISTS docs (id INTEGER PRIMARY KEY, content TEXT)");
if (isset($_POST['content'])) {
    $db->prepare('INSERT INTO docs (content) VALUES (?)')->execute([$_POST['content']]);
}
$q = $_GET['q'] ?? '';
$results = [];
if ($q) {
    $stmt = $db->prepare('SELECT * FROM docs WHERE content LIKE ?');
    $stmt->execute(['%'.$q.'%']);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?><form method="post">
<textarea name="content"></textarea><button>Add Doc</button>
</form>
<form method="get">
<input name="q" value="<?=htmlspecialchars($q)?>"><button>Search</button>
</form>
<ul>
<?php foreach($results as $r): ?>
<li><?=htmlspecialchars($r['content'])?></li>
<?php endforeach; ?>
</ul>

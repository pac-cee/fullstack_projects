<?php
// CSV Importer
$db = new PDO('sqlite:import.db');
$db->exec('CREATE TABLE IF NOT EXISTS data (id INTEGER PRIMARY KEY, val TEXT)');
if (isset($_FILES['csv'])) {
    $f = fopen($_FILES['csv']['tmp_name'], 'r');
    while ($row = fgetcsv($f)) {
        $db->prepare('INSERT INTO data (val) VALUES (?)')->execute([$row[0]]);
    }
    fclose($f);
}
$rows = $db->query('SELECT * FROM data')->fetchAll();
?>
<form method="post" enctype="multipart/form-data">
<input type="file" name="csv"><button>Import</button>
</form>
<ul>
<?php foreach($rows as $r): ?>
<li><?=htmlspecialchars($r['val'])?></li>
<?php endforeach; ?>
</ul>

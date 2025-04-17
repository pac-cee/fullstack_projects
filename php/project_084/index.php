<?php
// Image Gallery with Tags
$db = new PDO('sqlite:gallery.db');
$db->exec('CREATE TABLE IF NOT EXISTS images (id INTEGER PRIMARY KEY, fname TEXT, tags TEXT)');
if (isset($_FILES['img'])) {
    $tags = $_POST['tags'] ?? '';
    $fname = uniqid().'_'.basename($_FILES['img']['name']);
    move_uploaded_file($_FILES['img']['tmp_name'], $fname);
    $db->prepare('INSERT INTO images (fname, tags) VALUES (?,?)')->execute([$fname, $tags]);
}
$filter = $_GET['tag'] ?? '';
$q = $filter ? $db->prepare('SELECT * FROM images WHERE tags LIKE ?') : $db->query('SELECT * FROM images');
$rows = $filter ? ($q->execute(["%$filter%"]), $q->fetchAll()) : $q->fetchAll();
?>
<form method="post" enctype="multipart/form-data">
<input type="file" name="img"><input name="tags" placeholder="tags (comma)"><button>Upload</button>
</form>
<form method="get">
<input name="tag" placeholder="Filter by tag"><button>Filter</button>
</form>
<div>
<?php foreach($rows as $r): ?>
<img src="<?=$r['fname']?>" height="60"> Tags: <?=htmlspecialchars($r['tags'])?><br>
<?php endforeach; ?>
</div>

<?php
$db = new PDO('sqlite:data.db');
$db->exec("CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, name TEXT, email TEXT)");
if (isset($_GET['download'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="users.csv"');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['id','name','email']);
    foreach ($db->query('SELECT * FROM users') as $row) {
        fputcsv($out, $row);
    }
    fclose($out);
    exit;
}
?><a href="?download=1">Download CSV</a>

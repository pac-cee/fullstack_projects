<?php
$db = new PDO('sqlite:contacts.db');
$db->exec("CREATE TABLE IF NOT EXISTS contacts (id INTEGER PRIMARY KEY, name TEXT, email TEXT, message TEXT)");
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $db->prepare('INSERT INTO contacts (name,email,message) VALUES (?,?,?)')
        ->execute([$_POST['name'],$_POST['email'],$_POST['message']]);
    mail('admin@example.com', 'New Contact', $_POST['message']);
    echo 'Submitted!';
}
?><form method="post">
<input name="name" placeholder="Name"><br>
<input name="email" placeholder="Email"><br>
<textarea name="message" placeholder="Message"></textarea><br>
<button>Send</button>
</form>

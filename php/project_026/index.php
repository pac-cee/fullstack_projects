<?php
$url = 'https://jsonplaceholder.typicode.com/users';
$json = file_get_contents($url);
$data = json_decode($json, true);
echo "<table border='1'><tr><th>Name</th><th>Email</th></tr>";
foreach($data as $user) {
    echo "<tr><td>".htmlspecialchars($user['name'])."</td><td>".htmlspecialchars($user['email'])."</td></tr>";
}
echo "</table>";

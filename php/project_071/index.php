<?php
// REST API Client Example
$url = 'https://jsonplaceholder.typicode.com/posts';
$json = file_get_contents($url);
$data = json_decode($json, true);
?><h2>Posts</h2>
<table border="1"><tr><th>ID</th><th>Title</th></tr>
<?php foreach(array_slice($data,0,10) as $post): ?>
<tr><td><?=$post['id']?></td><td><?=htmlspecialchars($post['title'])?></td></tr>
<?php endforeach; ?>
</table>

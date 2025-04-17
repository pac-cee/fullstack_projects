<?php
// Requires: composer require elasticsearch/elasticsearch
require 'vendor/autoload.php';
use Elasticsearch\ClientBuilder;
$client = ClientBuilder::create()->build();
if (isset($_POST['doc'])) {
    $client->index(['index'=>'docs','body'=>['content'=>$_POST['doc']]]);
}
$q = $_GET['q'] ?? '';
$res = $q ? $client->search(['index'=>'docs','body'=>['query'=>['match'=>['content'=>$q]]]]) : [];
?><form method="post">
<input name="doc"><button>Add Doc</button>
</form>
<form method="get">
<input name="q"><button>Search</button>
</form>
<ul>
<?php foreach($res['hits']['hits']??[] as $hit): ?>
<li><?=htmlspecialchars($hit['_source']['content'])?></li>
<?php endforeach; ?>
</ul>

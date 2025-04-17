<?php
$items = ['apple','banana','grape','orange','lemon','pear','peach','plum'];
$q = strtolower(trim($_GET['q'] ?? ''));
$filtered = $q ? array_filter($items, function($item) use($q){return strpos($item, $q)!==false;}) : $items;
?><form>
<input name="q" value="<?=htmlspecialchars($q)?>"><button>Search</button>
</form>
<ul>
<?php foreach($filtered as $item): ?>
<li><?=htmlspecialchars($item)?></li>
<?php endforeach; ?>
</ul>

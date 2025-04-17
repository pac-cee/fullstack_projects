<?php
$items = range(1, 30);
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 5;
$totalPages = ceil(count($items)/$perPage);
$start = ($page-1)*$perPage;
$show = array_slice($items, $start, $perPage);
echo "<ul>";
foreach($show as $item) echo "<li>Item $item</li>";
echo "</ul><div>Pages: ";
for($i=1;$i<=$totalPages;$i++) {
    echo ($i==$page?"<b>$i</b>":"<a href='?page=$i'>$i</a>") . " ";
}
echo "</div>";

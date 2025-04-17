<?php
// Sitemap Visualizer
$xml = simplexml_load_file('../project_054/sitemap.xml');
function renderTree($urls) {
    echo "<ul>";
    foreach ($urls as $url) {
        echo "<li>".htmlspecialchars($url->loc)."</li>";
    }
    echo "</ul>";
}
renderTree($xml->url);

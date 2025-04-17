<?php
// Simple Web Crawler
function crawl($url, $depth=1, $max=2, &$visited=[]) {
    if ($depth > $max || isset($visited[$url])) return;
    $visited[$url] = true;
    $html = @file_get_contents($url);
    if (!$html) return;
    echo str_repeat('-', $depth)."> ".$url."<br>";
    preg_match_all('/href=["\'](http[^"\']+)["\']/', $html, $matches);
    foreach ($matches[1] as $link) crawl($link, $depth+1, $max, $visited);
}
$url = $_GET['url'] ?? 'https://example.com';
crawl($url);

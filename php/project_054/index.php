<?php
function listFiles($dir) {
    $files = [];
    foreach (scandir($dir) as $f) {
        if ($f === '.' || $f === '..') continue;
        $path = "$dir/$f";
        if (is_dir($path)) $files = array_merge($files, listFiles($path));
        elseif (preg_match('/\.(html|php)$/', $f)) $files[] = $path;
    }
    return $files;
}
$pages = listFiles(__DIR__);
$xml = "<?xml version='1.0' encoding='UTF-8'?>\n<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>\n";
foreach ($pages as $p) {
    $loc = htmlspecialchars('http://localhost/'.str_replace(__DIR__.'/', '', $p));
    $xml .= "  <url><loc>$loc</loc></url>\n";
}
$xml .= "</urlset>\n";
file_put_contents('sitemap.xml', $xml);
echo "Sitemap generated!";

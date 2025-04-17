<?php
// Static Site Generator: Markdown to HTML
$src = __DIR__.'/md';
$out = __DIR__.'/site';
if (!is_dir($src)) mkdir($src);
if (!is_dir($out)) mkdir($out);
foreach (glob("$src/*.md") as $mdfile) {
    $htmlfile = $out.'/'.basename($mdfile, '.md').'.html';
    $md = file_get_contents($mdfile);
    // Simple Markdown to HTML (real use: use a library)
    $html = '<html><body><pre>'.htmlspecialchars($md).'</pre></body></html>';
    file_put_contents($htmlfile, $html);
}
echo 'Site generated!';

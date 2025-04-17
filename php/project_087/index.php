<?php
// HTML to PDF Batch Converter
// Requires: composer require dompdf/dompdf
require 'vendor/autoload.php';
use Dompdf\Dompdf;
$src = __DIR__.'/html';
$out = __DIR__.'/pdf';
if (!is_dir($src)) mkdir($src);
if (!is_dir($out)) mkdir($out);
foreach (glob("$src/*.html") as $file) {
    $dompdf = new Dompdf();
    $dompdf->loadHtml(file_get_contents($file));
    $dompdf->render();
    file_put_contents($out.'/'.basename($file, '.html').'.pdf', $dompdf->output());
}
echo 'Batch conversion done!';

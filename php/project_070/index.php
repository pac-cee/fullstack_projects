<?php
// Requires: composer require dompdf/dompdf
require 'vendor/autoload.php';
use Dompdf\Dompdf;
$html = $_POST['html'] ?? '';
if ($html) {
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->render();
    $dompdf->stream('file.pdf');
    exit;
}
?><form method="post">
<textarea name="html" placeholder="HTML"></textarea><button>Generate PDF</button>
</form>

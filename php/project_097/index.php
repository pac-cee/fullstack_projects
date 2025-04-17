<?php
// File Upload Virus Scanner (ClamAV)
$msg = '';
if (isset($_FILES['file'])) {
    $tmp = $_FILES['file']['tmp_name'];
    $out = shell_exec("clamscan " . escapeshellarg($tmp));
    if (strpos($out, 'OK') !== false) {
        move_uploaded_file($tmp, basename($_FILES['file']['name']));
        $msg = 'File clean and uploaded.';
    } else {
        $msg = 'Virus detected! Upload rejected.';
    }
}
?>
<form method="post" enctype="multipart/form-data">
<input type="file" name="file"><button>Upload</button>
</form>
<?=$msg?>

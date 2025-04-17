<?php
$key = 'secretkey1234567'; // 16 chars for AES-128
$method = 'AES-128-CBC';
$iv = substr(hash('sha256', $key), 0, 16);
$msg = '';
if (isset($_POST['action']) && isset($_FILES['file'])) {
    $file = $_FILES['file']['tmp_name'];
    $data = file_get_contents($file);
    if ($_POST['action'] === 'encrypt') {
        $enc = openssl_encrypt($data, $method, $key, 0, $iv);
        file_put_contents('encrypted.dat', $enc);
        $msg = 'File encrypted.';
    } elseif ($_POST['action'] === 'decrypt') {
        $dec = openssl_decrypt($data, $method, $key, 0, $iv);
        file_put_contents('decrypted.txt', $dec);
        $msg = 'File decrypted.';
    }
}
?>
<form method="post" enctype="multipart/form-data">
<input type="file" name="file">
<button name="action" value="encrypt">Encrypt</button>
<button name="action" value="decrypt">Decrypt</button>
</form>
<?=$msg?>

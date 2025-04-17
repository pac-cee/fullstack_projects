<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
}
$valid = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valid = ($_POST['csrf_token'] ?? '') === $_SESSION['csrf_token'];
}
?><form method="post">
<input type="hidden" name="csrf_token" value="<?=htmlspecialchars($_SESSION['csrf_token'])?>">
<input name="data"><button>Submit</button>
</form>
<?php if($_SERVER['REQUEST_METHOD']==='POST') echo $valid?'Valid CSRF!':'Invalid CSRF!'; ?>

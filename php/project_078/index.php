<?php
session_start();
$step = $_GET['step'] ?? 1;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['form'][$step] = $_POST;
    $step++;
    if ($step > 3) { $all = array_merge(...$_SESSION['form']); session_destroy(); echo 'Submitted: '.json_encode($all); exit; }
    header('Location: ?step='.$step); exit;
}
?><form method="post">
<?php if ($step == 1): ?>
<input name="name" placeholder="Name">
<?php elseif ($step == 2): ?>
<input name="email" placeholder="Email">
<?php elseif ($step == 3): ?>
<input name="age" placeholder="Age">
<?php endif; ?>
<button>Next</button>
</form>

<?php

// form_handler.php

$name = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
}
?>
<!DOCTYPE html>
<html>
<head><title>Form Handler</title></head>
<body>
<form method="post" action="">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?php echo $name; ?>">
    <button type="submit">Submit</button>
</form>
<?php if ($name): ?>
    <p>Hello, <?php echo $name; ?>!</p>
<?php endif; ?>
</body>
</html>

<?php
session_start();
$products = [1=>"Apple",2=>"Banana",3=>"Cherry"];
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
if (isset($_POST['add'])) {
    $id = (int)$_POST['add'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
}
if (isset($_POST['remove'])) {
    $id = (int)$_POST['remove'];
    unset($_SESSION['cart'][$id]);
}
?><h2>Products</h2>
<form method="post">
<?php foreach($products as $id=>$name): ?>
<button name="add" value="<?=$id?>">Add <?=$name?></button>
<?php endforeach; ?>
</form>
<h2>Cart</h2>
<ul>
<?php foreach($_SESSION['cart'] as $id=>$qty): ?>
<li><?=$products[$id]?> x <?=$qty?> <form style="display:inline" method="post"><button name="remove" value="<?=$id?>">Remove</button></form></li>
<?php endforeach; ?>
</ul>

<?php
$lang = $_GET['lang'] ?? 'en_US';
putenv("LC_ALL=$lang");
setlocale(LC_ALL, $lang);
bindtextdomain('messages', __DIR__.'/locale');
textdomain('messages');
?><form method="get">
<select name="lang">
  <option value="en_US">English</option>
  <option value="es_ES">Español</option>
</select>
<button>Change</button>
</form>
<h1><?=_("Welcome")?></h1>

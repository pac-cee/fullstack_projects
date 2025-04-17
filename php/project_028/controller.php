<?php
require_once 'model.php';
require_once 'view.php';
function handleRequest() {
    $msg = getMessage();
    render($msg);
}

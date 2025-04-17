<?php
session_start();
$db = new PDO('sqlite:cms.db');
$db->exec('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, name TEXT, pass TEXT, role TEXT)');
$db->exec('CREATE TABLE IF NOT EXISTS pages (id INTEGER PRIMARY KEY, title TEXT, body TEXT)');
// Auth, role check, page CRUD, user CRUD (simplified for brevity)
echo '<h2>CMS Home</h2>';

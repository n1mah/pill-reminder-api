<?php
try {
    $pdo = new PDO("mysql:dbname=pillremind;host=localhost", 'root2', '');
    $pdo->exec("set names utf8;");
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
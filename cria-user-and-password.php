<?php

$pdo = new \PDO('mysql:host=localhost;dbname=aluraplay;charset=utf8mb4', 'root', 'Root@123');

$mail = $argv[1];
$password = $argv[2];
$hash = password_hash($password, PASSWORD_ARGON2I);

$sql = 'INSERT INTO users (email, password) VALUES(?, ?)';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $mail);
$stmt->bindValue(2, $hash);
$stmt->execute();

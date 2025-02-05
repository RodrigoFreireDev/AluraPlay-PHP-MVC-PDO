<?php

require 'src/conexao.php';

$sql = 'DELETE FROM videos WHERE id = ?;';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $_GET['id'], PDO::PARAM_INT);

if ($stmt->execute() === false) {
    header('Location: /index.php?sucesso=0');
    exit;
} else {
    header('Location: /index.php?sucesso=1');
    exit;
}

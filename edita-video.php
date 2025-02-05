<?php

require 'src/conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$title = filter_input(INPUT_POST, 'titulo');

if ($url === false || $title === false || $id === false) {
    header('location: /index.php?sucesso=0');
    exit();
}

$sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id;';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':url', $url);
$stmt->bindValue(':title', $title);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

if ($stmt->execute() === true) {
    header('Location: index.php?sucesso=1');
    exit();
} else {
    header('Location: index.php?sucesso=0');
    exit();
}

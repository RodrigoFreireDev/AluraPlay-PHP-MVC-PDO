<?php

$sql = 'DELETE FROM videos WHERE id = ?;';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $_GET['id'], PDO::PARAM_INT);

if ($stmt->execute() === false) {
    header('Location: /?sucesso=0');
    exit;
} else {
    header('Location: /?sucesso=1');
    exit;
}

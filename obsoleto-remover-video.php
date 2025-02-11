<?php

use Alura\Mvc\Repository\VideoRepository;

$repository = new VideoRepository($pdo);

if ($repository->removeVideo($_GET['id']) === false) {
    header('Location: /?sucesso=0');
    exit;
} else {
    header('Location: /?sucesso=1');
    exit;
}

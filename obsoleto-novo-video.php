<?php

// Acesso direto
// $url = $_POST['url'];
// $title = $_POST['titulo'];
// OU
// Acesso com filtro

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$title = filter_input(INPUT_POST, 'titulo');
// Observações:
    // Normalmente os framworkes já faz isso por baixo dos panos pra gente.
    // Se quisermos usar filtros em variaveis, basta ao invez de usar o 'filter_input', usamos o 'filter_var'(filter_input não usa o parametro de INPUT_POST)!

if ($url === false || $title === false) {
    header('location: /?sucesso=0');
    exit();
}

$repository = new VideoRepository($pdo);
// $repository->addVideo(new Video($url, $title));

if ($repository->addVideo(new Video($url, $title))=== false) {
    header('location: /?sucesso=0');
    exit();
} else {
    header('location: /?sucesso=1');
    exit();
}

<?php

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$title = filter_input(INPUT_POST, 'titulo');


if ($url === false || $title === false || $id === false || $id === null) {
    header('location: /?sucesso=0');
    exit();
}

$repository = new VideoRepository($pdo);

$video = new Video($url, $title);
$video->setId($id);

if ($repository->updateVideo($video) === true) {

    header('Location: /?sucesso=1');
    exit();
} else {
    header('Location: /?sucesso=0');
    exit();
}

<?php

// Vantagem do 'Front Contoller': Com ele, só precisamos usar o autoloader uma vez. No caso nesse arquivo.
declare(strict_types=1);

require __DIR__.'/../src/conexao.php';
require __DIR__.'/../vendor/autoload.php';

if (!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER['PATH_INFO'] === '/') {
    require_once __DIR__.'/../listagem-videos.php';
} elseif ($_SERVER['PATH_INFO'] === '/novo-video') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once 'pages/formulario.php';
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once __DIR__.'/../novo-video.php';
    }
} elseif ($_SERVER['PATH_INFO'] === '/edita-video') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once 'pages/formulario.php';
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once __DIR__.'/../edita-video.php';
    }
} elseif ($_SERVER['PATH_INFO'] === '/remover-video') {
    require_once __DIR__.'/../remover-video.php';
} else {
    // echo $path = __DIR__.'/../404.html';
    // exit();
    // require_once 'pages/404.php';
    // $path = __DIR__.'/pages/404.php';
    // header("Location: $path");
    // $path2 = __DIR__.'/../404.php';
    // header("Location: $path2");
    // require_once __DIR__.'/../404.php';
    // exit();
    http_response_code(404);
}

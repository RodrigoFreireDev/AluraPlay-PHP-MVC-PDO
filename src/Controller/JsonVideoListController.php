<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class JsonVideoListController implements RequestHandlerInterface
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $videoList = array_map(function (Video $video): array {
            return [
                'url' => $video->url,
                'title' => $video->title,
                'file_path' => $video->getFilePath() === null ? null : '/img/uploads/' . $video->getFilePath(),
            ];
        }, $this->videoRepository->allVideos());

        return new Response(200, [
            'Content-Type' => 'application/json'
        ], json_encode($videoList));
    }
}

// --------------------------------------------------------------
// Rodrigo:
// namespace Alura\Mvc\Controller;

// use Alura\Mvc\Entity\Video;
// use Alura\Mvc\Repository\VideoRepository;
// use Nyholm\Psr7\Response;
// use Psr\Http\Message\ResponseInterface;
// use Psr\Http\Message\ServerRequestInterface;

// class JsonVideoListController implements Controller
// {
//     public function __construct(private VideoRepository $videoRepository) {}

//     public function processRequest(ServerRequestInterface $request): ResponseInterface
//     {
//         $videoList = array_map(function (Video $video): array {
//             return [
//                 'url' => $video->url,
//                 'title' => $video->title,
//                 'file_path' => '/img/uploads/' . $video->getFilePath(),
//             ];
//         }, $this->videoRepository->allVideos());

//         // echo json_encode($videoList);
//         return new Response(200, [
//             'Content-Type' => 'aplication/json' // Informando que o retorno é do tipo 'json'
//         ], json_encode($videoList));

//         // Para conseguir usar:
//             // Postman(tipo de rota = GET):
//             //     >link:
//             //         http://localhost:8080/videos-json
//             //     >Cookies:
//             //         Add Domin: localhost
//             //         Add Cookie:  PHPSESSID=9o1hduj4l88p01rvlt0j7992vh; Path=/
//     }
// }

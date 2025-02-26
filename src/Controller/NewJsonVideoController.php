<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class NewJsonVideoController implements RequestHandlerInterface
{
    public function __construct(private VideoRepository $videoRepository)
    {
        
    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // $request = file_get_contents('php://input');
        $request = $request->getBody()->getContents();

        $videoData = json_decode($request, true); // 'json_decode': O segundo parametro como true, retorna o array como associativo!
        
        $video = new Video($videoData['url'], $videoData['title']);
        $this->videoRepository->addVideo($video);

        return new Response(201);

        // Para conseguir usar:
            // Postman(tipo de rota = POST):
            //     >link:
            //         http://localhost:8080/videos
            //     >body(json):
            //         {
            //             "url": "https://www.youtube.com/embed/B-7e-ZpIWAs?si=LMb-2Eu-9QDdf0cx",
            //             "title": "Login com JWT"
            //         }
            //     >Cookies:
            //         Add Domin: localhost
            //         Add Cookie:  PHPSESSID=9o1hduj4l88p01rvlt0j7992vh; Path=/
    }
}
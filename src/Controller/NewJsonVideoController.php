<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class NewJsonVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
        
    }
    public function processRequest(): void
    {
        $request = file_get_contents('php://input');

        $videoData = json_decode($request, true); // 'json_decode': O segundo parametro como true, retorna o array como associativo!
        
        $video = new Video($videoData['url'], $videoData['title']);
        $this->videoRepository->addVideo($video);

        http_response_code(201);

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
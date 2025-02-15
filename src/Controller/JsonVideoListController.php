<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class JsonVideoListController implements Controller
{
    public function __construct(private VideoRepository $videoRepository) {}

    public function processRequest(): void
    {
        $videoList = array_map(function (Video $video): array {
            return [
                'url' => $video->url,
                'title' => $video->title,
                'file_path' => '/img/uploads/' . $video->getFilePath(),
            ];
        }, $this->videoRepository->allVideos());

        echo json_encode($videoList);

        // Para conseguir usar:
            // Postman(tipo de rota = GET):
            //     >link:
            //         http://localhost:8080/videos-json
            //     >Cookies:
            //         Add Domin: localhost
            //         Add Cookie:  PHPSESSID=9o1hduj4l88p01rvlt0j7992vh; Path=/
    }
}

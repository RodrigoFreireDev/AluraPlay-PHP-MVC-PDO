<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class NewVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
        // $this->videoRepository = $videoRepository;
    }

    public function processRequest(): void
    {
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        $title = filter_input(INPUT_POST, 'titulo');
    
        if ($url === false || $title === false) {
            header('location: /?sucesso=0');
            exit();
        }
    
        if ($this->videoRepository->addVideo(new Video($url, $title))=== false) {
            header('location: /?sucesso=0');
            exit();
        } else {
            header('location: /?sucesso=1');
            exit();
        }
    }
}
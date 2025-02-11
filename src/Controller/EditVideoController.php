<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class EditVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
        // $this->videoRepository = $videoRepository;
    }

    public function processRequest(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        $title = filter_input(INPUT_POST, 'titulo');


        if ($url === false || $title === false) {
            header('location: /?sucesso=0');
            exit();
        }

        if ($id === false || $id === null) {
            header('location: /?sucesso=0');
            exit();
        }

        $video = new Video($url, $title);
        $video->setId($id);

        if ($this->videoRepository->updateVideo($video) === true) {
            header('Location: /?sucesso=1');
            exit();
        } else {
            header('Location: /?sucesso=0');
            exit();
        }
    }
}

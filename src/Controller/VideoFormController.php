<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class VideoFormController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
        // $this->videoRepository = $videoRepository;
    }

    public function processRequest(): void
    {
        // $action = "/../../../../novo-video";
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        $video = null;

        if (isset($id)) {
            // $action = "/../../../../edita-video?id=".$id;
            $video = $this->videoRepository->videoById($id);
        }

        require __DIR__.'/../../views/video-form.php';
    }
}

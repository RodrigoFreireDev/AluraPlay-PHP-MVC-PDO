<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\HtmlRendereTrait;
use Alura\Mvc\Repository\VideoRepository;

class VideoFormController implements Controller
{
    use HtmlRendereTrait;

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

        echo $this->rederTemplate(
            'video-form',
            ['video' => $video]
    );
    }
}

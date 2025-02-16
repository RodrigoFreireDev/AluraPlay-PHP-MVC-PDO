<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class VideoListController extends ViewsController
{
    public function __construct(private VideoRepository $videoRepository)
    {
        // $this->videoRepository = $videoRepository;
    }

    public function processRequest(): void
    {
        $videoList = $this->videoRepository->allVideos();

        echo $this->rederTemplate(
            'video-list',
            ['videoList' => $videoList]
        );
    }
}

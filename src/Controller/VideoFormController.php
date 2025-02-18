<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class VideoFormController implements RequestHandlerInterface
{
    public function __construct(
        private VideoRepository $videoRepository,
        private Engine $templates
    ) {
        // $this->videoRepository = $videoRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // $action = "/../../../../novo-video";
        $queryParams = $request->getQueryParams();
        $id = filter_var($queryParams['id'] ?? '', FILTER_VALIDATE_INT);

        /** @var ?Video $video */
        $video = null;

        if ($id !== false && $id !== null) {
            // $action = "/../../../../edita-video?id=".$id;
            $video = $this->videoRepository->videoById($id);
        }

        return new Response(200, body: $this->templates->render(
            'video-form', [
                'id' => $id,
                'video' => $video,
            ]));
    }
}

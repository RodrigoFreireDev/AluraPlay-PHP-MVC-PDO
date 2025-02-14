<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class ThumbnailRemoverConrtoller implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
        
    }

    public function processRequest(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id === false || $id === null) {
            header('Location: /?sucesso=0');
            exit();
        }

        if ($this->videoRepository->thumbnailRemover($id) === true) {
            header('Location: /?sucesso=1');
            exit();
        } else {
            header('Location: /?sucesso=0');
            exit();
        }
    }
}
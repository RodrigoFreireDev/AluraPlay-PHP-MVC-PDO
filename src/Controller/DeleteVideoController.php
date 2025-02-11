<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class DeleteVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
        // $this->videoRepository = $videoRepository;
    }

    public function processRequest(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id === false || $id === null) {
            header('location: /?sucesso=0');
            exit();
        }

        if ($this->videoRepository->removeVideo($id) === false) {
            header('Location: /?sucesso=0');
            exit;
        } else {
            header('Location: /?sucesso=1');
            exit;
        }
    }
}
<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\FlashMessageTrait;
use Alura\Mvc\Repository\VideoRepository;

class DeleteVideoController implements Controller
{
    use FlashMessageTrait;

    public function __construct(private VideoRepository $videoRepository)
    {
        // $this->videoRepository = $videoRepository;
    }

    public function processRequest(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id === false || $id === null) {
            $this->addErrorMessage('Erro na deleção!');
            header('Location: /');
            exit();
        }

        if ($this->videoRepository->removeVideo($id) === false) {
            $this->addErrorMessage('Erro na deleção!');
            header('Location: /');
            exit;
        } else {
            header('Location: /?sucesso=1');
            exit;
        }
    }
}
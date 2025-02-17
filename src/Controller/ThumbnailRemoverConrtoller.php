<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\FlashMessageTrait;
use Alura\Mvc\Repository\VideoRepository;

class ThumbnailRemoverConrtoller implements Controller
{
    use FlashMessageTrait;

    public function __construct(private VideoRepository $videoRepository)
    {
        
    }

    public function processRequest(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id === false || $id === null) {
            $this->addErrorMessage('Erro na remoção de Thumbnail!');
            header('Location: /');
            exit();
        }

        if ($this->videoRepository->thumbnailRemover($id) === true) {
            header('Location: /?sucesso=1');
            exit();
        } else {
            $this->addErrorMessage('Erro na remoção de Thumbnail!');
            header('Location: /');
            exit();
        }
    }
}
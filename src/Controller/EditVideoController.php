<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Helper\FlashMessageTrait;
use Alura\Mvc\Repository\VideoRepository;

class EditVideoController implements Controller
{
    use FlashMessageTrait;

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
            $this->addErrorMessage('Dados Invalidos!');
            header('Location: /');
            exit();
        }

        if ($id === false || $id === null) {
            $this->addErrorMessage('Dados Invalidos!');
            header('Location: /');
            exit();
        }

        $video = new Video($url, $title);
        $video->setId($id);

        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($_FILES['image']['tmp_name']);

            if (str_starts_with($mimeType, 'image/')) {
                // $safeFileName = uniqid('upload_') .'_'. pathinfo($_FILES['image']['name'], PATHINFO_BASENAME); // 'PATHINFO_BASENAME' camada de segurança que atribui nome com nome somente e não outros dados como caminhos por exemplo 'exemplo/../../nome-file.jpg' fica: 'nome-file.jpg'
                // $safeFileName = uniqid('upload_') . '_' . $video->gerarSlug(pathinfo($_FILES['image']['name'], PATHINFO_BASENAME)); // 'PATHINFO_BASENAME' camada de segurança que atribui nome com nome somente e não outros dados como caminhos por exemplo 'exemplo/../../nome-file.jpg' fica: 'nome-file.jpg'
                $safeFileName = uniqid('upload_') . '_' . $video->gerarSlug(basename($_FILES['image']['name'])); // 'PATHINFO_BASENAME' camada de segurança que atribui nome com nome somente e não outros dados como caminhos por exemplo 'exemplo/../../nome-file.jpg' fica: 'nome-file.jpg'
                move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    // __DIR__ . '/../../public/img/uploads/' . uniqid() . $_FILES['image']['name']
                    __DIR__ . '/../../public/img/uploads/' . $safeFileName
                );

                $video->setFilePath($safeFileName);
            }
        }

        if ($this->videoRepository->updateVideo($video) === true) {
            header('Location: /?sucesso=1');
            exit();
        } else {
            $this->addErrorMessage('Erro na edição!');
            header('Location: /');
            exit();
        }
    }
}

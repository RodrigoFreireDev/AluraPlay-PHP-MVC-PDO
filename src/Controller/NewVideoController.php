<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Helper\FlashMessageTrait;
use Alura\Mvc\Repository\VideoRepository;

class NewVideoController implements Controller
{
    use FlashMessageTrait;

    public function __construct(private VideoRepository $videoRepository)
    {
        // $this->videoRepository = $videoRepository;
    }

    public function processRequest(): void
    {
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        $title = filter_input(INPUT_POST, 'titulo');


        if ($url === false || $title === false) {
            $this->addErrorMessage('Dados Invalidos!');
            header('Location: /novo-video');
            exit();
        }

        $video = new Video($url, $title);

        // if ($_FILES['image']['error'] === 0) {
        // ou
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

        if ($this->videoRepository->addVideo($video) === false) {
            $this->addErrorMessage('Erro de cadastro!');
            header('Location: /novo-video');
        } else {
            header('location: /?sucesso=1');
            exit();
        }
    }
}

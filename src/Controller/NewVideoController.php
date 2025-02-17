<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Helper\FlashMessageTrait;
use Alura\Mvc\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Server\RequestHandlerInterface;

class NewVideoController implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $requestBody = $request->getParsedBody();
        $url = filter_var($requestBody['url'], FILTER_VALIDATE_URL);
        if ($url === false) {
            $this->addErrorMessage('URL inválida');
            return new Response(302, [
                'Location' => '/'
            ]);
        }
        $titulo = filter_var($requestBody['titulo']);
        if ($titulo === false) {
            $this->addErrorMessage('Título não informado');
            return new Response(302, [
                'Location' => '/'
            ]);
        }

        $video = new Video($url, $titulo);
        $files = $request->getUploadedFiles();
        /** @var UploadedFileInterface $uploadedImage */
        $uploadedImage = $files['image'];
        if ($uploadedImage->getError() === UPLOAD_ERR_OK) {
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $tmpFile = $uploadedImage->getStream()->getMetadata('uri');
            $mimeType = $finfo->file($tmpFile);

            if (str_starts_with($mimeType, 'image/')) {
                $safeFileName = uniqid('upload_') . '_' . pathinfo($uploadedImage->getClientFilename(), PATHINFO_BASENAME);
                $uploadedImage->moveTo(__DIR__ . '/../../public/img/uploads/' . $safeFileName);
                $video->setFilePath($safeFileName);
            }
        }

        $success = $this->videoRepository->addVideo($video);

        if ($success === false) {
            $this->addErrorMessage('Erro ao cadastrar vídeo');
            return new Response(302, [
                'Location' => '/novo-video'
            ]);
        }

        return new Response(302, [
            'Location' => '/'
        ]);
    }
}

// -------------------------------------------------
// Rodrigo:
// namespace Alura\Mvc\Controller;

// use Alura\Mvc\Entity\Video;
// use Alura\Mvc\Helper\FlashMessageTrait;
// use Alura\Mvc\Repository\VideoRepository;
// use Nyholm\Psr7\Response;
// use Psr\Http\Message\ResponseInterface;
// use Psr\Http\Message\ServerRequestInterface;

// class NewVideoController implements Controller
// {
//     use FlashMessageTrait;

//     public function __construct(private VideoRepository $videoRepository)
//     {
//         // $this->videoRepository = $videoRepository;
//     }

//     public function processRequest(ServerRequestInterface $request): ResponseInterface
//     {
//         $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
//         $title = filter_input(INPUT_POST, 'titulo');


//         if ($url === false || $title === false) {
//             $this->addErrorMessage('Dados Invalidos!');
//             return new Response(302, [
//                 'Location' => '/novo-video'
//             ]);
//         }

//         $video = new Video($url, $title);

//         // if ($_FILES['image']['error'] === 0) {
//         // ou
//         if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
//             $finfo = new \finfo(FILEINFO_MIME_TYPE);
//             $mimeType = $finfo->file($_FILES['image']['tmp_name']);

//             if (str_starts_with($mimeType, 'image/')) {
//                 // $safeFileName = uniqid('upload_') .'_'. pathinfo($_FILES['image']['name'], PATHINFO_BASENAME); // 'PATHINFO_BASENAME' camada de segurança que atribui nome com nome somente e não outros dados como caminhos por exemplo 'exemplo/../../nome-file.jpg' fica: 'nome-file.jpg'
//                 // $safeFileName = uniqid('upload_') . '_' . $video->gerarSlug(pathinfo($_FILES['image']['name'], PATHINFO_BASENAME)); // 'PATHINFO_BASENAME' camada de segurança que atribui nome com nome somente e não outros dados como caminhos por exemplo 'exemplo/../../nome-file.jpg' fica: 'nome-file.jpg'
//                 $safeFileName = uniqid('upload_') . '_' . $video->gerarSlug(basename($_FILES['image']['name'])); // 'PATHINFO_BASENAME' camada de segurança que atribui nome com nome somente e não outros dados como caminhos por exemplo 'exemplo/../../nome-file.jpg' fica: 'nome-file.jpg'
//                 move_uploaded_file(
//                     $_FILES['image']['tmp_name'],
//                     // __DIR__ . '/../../public/img/uploads/' . uniqid() . $_FILES['image']['name']
//                     __DIR__ . '/../../public/img/uploads/' . $safeFileName
//                 );

//                 $video->setFilePath($safeFileName);
//             }
//         }

//         if ($this->videoRepository->addVideo($video) === false) {
//             $this->addErrorMessage('Erro de cadastro!');
//             return new Response(302, [
//                 'Location' => '/novo-video'
//             ]);
//         } else {
//             return new Response(302, [
//                 'Location' => '/'
//             ]);
//         }
//     }
// }

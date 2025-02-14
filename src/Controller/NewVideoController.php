<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class NewVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
        // $this->videoRepository = $videoRepository;
    }

    public function processRequest(): void
    {
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        $title = filter_input(INPUT_POST, 'titulo');

    
        if ($url === false || $title === false) {
            header('location: /?sucesso=0');
            exit();
        }

        $video = new Video($url, $title);

        // if ($_FILES['image']['error'] === 0) {
            // ou
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                // __DIR__ . '/../../public/img/uploads/' . uniqid() . $_FILES['image']['name']
                __DIR__ . '/../../public/img/uploads/' . $_FILES['image']['name']
            );

            $video->setFilePath($_FILES['image']['name']);
        }
    
        if ($this->videoRepository->addVideo($video)=== false) {
            header('location: /?sucesso=0');
            exit();
        } else {
            header('location: /?sucesso=1');
            exit();
        }
    }
}
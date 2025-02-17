<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\FlashMessageTrait;
use Alura\Mvc\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ThumbnailRemoverConrtoller implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(private VideoRepository $videoRepository)
    {
        
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $QueryParams = $request->getQueryParams();
        $id = filter_var($QueryParams['id'], FILTER_VALIDATE_INT);

        if ($id === false || $id === null) {
            $this->addErrorMessage('Erro na remoção de Thumbnail!');
            return new Response(302, [
                'Location' => '/'
            ]);
        }

        if ($this->videoRepository->thumbnailRemover($id) === true) {
            return new Response(302, [
                'Location' => '/'
            ]);
        } else {
            $this->addErrorMessage('Erro na remoção de Thumbnail!');
            return new Response(302, [
                'Location' => '/'
            ]);
        }
    }
}
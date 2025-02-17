<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\HtmlRendereTrait;
use Alura\Mvc\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Error404Controller implements RequestHandlerInterface
{
    use HtmlRendereTrait;

    public function handle(ServerRequestInterface $resquest): ResponseInterface
    {
        return new Response(404, body:$this->rederTemplate('404-html'));
    }
}
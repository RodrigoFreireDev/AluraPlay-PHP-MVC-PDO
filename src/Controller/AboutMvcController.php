<?php


namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\HtmlRendereTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AboutMvcController implements RequestHandlerInterface
{
    use HtmlRendereTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(200, body: $this->rederTemplate('about-mvc'));
    }
}

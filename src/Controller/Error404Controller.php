<?php

namespace Alura\Mvc\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Error404Controller implements RequestHandlerInterface
{
    // public function __construct(private ?Engine $templates) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // return new Response(200, body: $this->templates->render('404-html'));
        return new Response(404);
    }
}

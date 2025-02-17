<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\HtmlRendereTrait;
use Alura\Mvc\Repository\VideoRepository;

class Error404Controller implements Controller
{
    use HtmlRendereTrait;

    public function processRequest(): void
    {
        echo $this->rederTemplate('404-html');
    }
}
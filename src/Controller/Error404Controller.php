<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class Error404Controller extends ViewsController
{
    public function processRequest(): void
    {
        $this->rederTemplate('404-html');
    }
}
<?php


namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\HtmlRendereTrait;

class AboutMvcController implements Controller
{
    use HtmlRendereTrait;

    public function processRequest(): void
    {
        echo $this->rederTemplate('about-mvc');
    }
}

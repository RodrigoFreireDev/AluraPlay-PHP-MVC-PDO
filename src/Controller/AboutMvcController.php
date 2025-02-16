<?php


namespace Alura\Mvc\Controller;

class AboutMvcController extends ViewsController
{
    public function processRequest(): void
    {
        echo $this->rederTemplate('about-mvc');
    }
}

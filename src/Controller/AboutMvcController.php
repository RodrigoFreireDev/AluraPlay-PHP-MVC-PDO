<?php


namespace Alura\Mvc\Controller;

class AboutMvcController extends ViewsController
{
    public function processRequest(): void
    {
        $this->rederTemplate('about-mvc');
    }
}

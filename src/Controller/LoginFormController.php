<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\HtmlRendereTrait;

class LoginFormController implements Controller
{
    use HtmlRendereTrait;

    public function processRequest(): void
    {
        if (array_key_exists('logado', $_SESSION) && $_SESSION['logado'] === true) {
            header('Location: /');
            return;
        }

        echo $this->rederTemplate('login-form');
    }
}
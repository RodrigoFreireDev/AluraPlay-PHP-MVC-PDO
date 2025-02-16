<?php

namespace Alura\Mvc\Controller;

class LoginFormController extends ViewsController
{
    public function processRequest(): void
    {
        if (array_key_exists('logado', $_SESSION) && $_SESSION['logado'] === true) {
            header('Location: /');
            return;
        }

        $this->rederTemplate('login-form');
    }
}
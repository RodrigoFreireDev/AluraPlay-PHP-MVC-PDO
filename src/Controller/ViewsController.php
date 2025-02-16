<?php

namespace Alura\Mvc\Controller;

abstract class ViewsController implements Controller
{
    private const TEMPLATE_PATH = __DIR__ . '/../../views/';

    // protected: somente as classes que extendem essa, vão ter acesso a esse metodo!
    protected function rederTemplate(string $templateName, array $context = []): void
    {   
        extract($context);
        require_once self::TEMPLATE_PATH . $templateName . '.php'; // self: Por não ser global. Com o 'self', buscamos em nós mesmos(nessa class) esse dado.
    }
}
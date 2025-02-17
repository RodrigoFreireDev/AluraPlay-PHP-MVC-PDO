<?php

namespace Alura\Mvc\Helper;

trait HtmlRendereTrait
{
    // private const TEMPLATE_PATH = __DIR__ . '/../../views/'; // Apartir do PHP 8.2, as Traits suportam 'const'!

    private function rederTemplate(string $templateName, array $context = []): string
    {
        $templatePath = __DIR__ . '/../../views/';
        extract($context);

        ob_start(); // iniciando o buffer de saída!

        require_once $templatePath . $templateName . '.php'; // self: Por não ser global. Com o 'self', buscamos em nós mesmos(nessa class) esse dado.

        // $content = ob_get_contents();// pega o conteúdo do buffer!
        // ob_clean();// Limpa buffer(Para poupar memória)!
            // OU
        $content = ob_get_clean();// pega o conteúdo do buffer e limpa!

        return $content;
    }
}

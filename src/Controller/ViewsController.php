<?php

namespace Alura\Mvc\Controller;

abstract class ViewsController implements Controller
{
    private const TEMPLATE_PATH = __DIR__ . '/../../views/';

    // protected: somente as classes que extendem essa, vão ter acesso a esse metodo!
    // protected function rederTemplate(string $templateName, array $context = []): void

    // Sem buffer:
    // protected function rederTemplate(string $templateName, array $context = []): void
    // {
    //     extract($context);
    //     require_once self::TEMPLATE_PATH . $templateName . '.php'; // self: Por não ser global. Com o 'self', buscamos em nós mesmos(nessa class) esse dado.
    // }

    // Com buffer:
    protected function rederTemplate(string $templateName, array $context = []): string
    {
        extract($context);

        ob_start(); // iniciando o buffer de saída!

        require_once self::TEMPLATE_PATH . $templateName . '.php'; // self: Por não ser global. Com o 'self', buscamos em nós mesmos(nessa class) esse dado.

        // $content = ob_get_contents();// pega o conteúdo do buffer!
        // ob_clean();// Limpa buffer(Para poupar memória)!
            // OU
        $content = ob_get_clean();// pega o conteúdo do buffer e limpa!

        return $content;

        // Sobre:
        // Dessa maneira, podemos manipular esse conteúdo. Outra opção mais comum é, em vez de exibir
        // o conteúdo com echo, retornar algum tipo de resposta (response) com vários cabeçalhos (usando a função header()) ou com conteúdo.

        // Assim, em index.php, em vez de simplesmente chamar o método processaRequisicao() ao final do
        // arquivo, pegaríamos essa resposta e faríamos um echo $response->body(), por exemplo.

        // Contudo, essa abordagem também tem desvantagens. Por padrão, o buffer de saída sempre existe
        // e o próprio PHP exibe seu conteúdo automaticamente, quando julga necessário. Quando chamamos a função ob_start(), estamos sobrescrevendo esse buffer e controlando o fluxo do buffer de saída.

        // Sem usar o ob_start(), tínhamos a opção de usar o método flush() para exibir o buffer padrão.
        // Por exemplo, no arquivo inicio-html.php, poderíamos inserir a função flush() após o fechamendo da tag <head>
        // ----------------------------------
            // O output buffer do PHP pode nos trazer funcionalidades bem interessantes, como vimos nesse vídeo. Porém, podem haver casos onde nós gostaríamos de burlar esse controle e escrever dados da saída padrão do processo.

            // O post a seguir te mostra como fazer isso, além de apresentar mais detalhes sobre o wrapper de streams php://:
            // Link: https://dias.dev/2020-11-03-wraper-de-streams-php/#google_vignette
    }
}
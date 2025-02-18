<?php

// Vantagem do 'Front Contoller': Com ele, só precisamos usar o autoloader uma vez. No caso nesse arquivo.
declare(strict_types=1);

use Alura\Mvc\Controller\Error404Controller;
use Alura\Mvc\Repository\VideoRepository;
use League\Plates\Engine;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/conexao.php';

$repository = new VideoRepository($pdo);
$template = new Engine();

// Depois de termos o arquivo routes.php:
$routes = require_once __DIR__ . '/../config/routes.php';

/** @var ContainerInterface $diContainer */
$diContainer = require_once __DIR__ . '/../config/dependencies.php'; 

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

// session start. Esta função verifica se foi enviado algum Cookie, e caso não, ela gera um Cookie, cria uma pasta e o envia o Cookie para o navegador do cliente.
session_start();
//'session_regenerate_id();' // Acada nova requisição(login) é gerado um ID diferente e não mais o mesmo como antes! Deixando mais seguro o processo de login.
if (isset($_SESSION['logado'])) {
    $originalInfo = $_SESSION['logado'];
    unset($_SESSION['logado']);
    session_regenerate_id();
    $_SESSION['logado'] = $originalInfo;
}

$isLoginRoute = $pathInfo === '/login';
if (!array_key_exists('logado', $_SESSION) && !$isLoginRoute) {
    header('Location: /login');
    return;
}

$key = "$httpMethod|$pathInfo";

if (array_key_exists($key, $routes)) {
    $controllerClass = $routes["$httpMethod|$pathInfo"];
    // Como foi possível instanciar um objeto de uma classe('$controller = new $controllerClass($repository);') a partir de uma string com o nome dessa classe?
        // Instanciando diretamente pelo valor da variável!
            // Sobre:
            // O PHP permite que nós utilizemos uma variável como o nome da classe que queremos instanciar, como new $nomeDaClasse();. Isso facilitou nossa vida fazendo com que o conhecimento de Reflection não fosse necessário. Mas para casos mais complexos você pode precisar de Reflection, por isso, aqui está o link do curso de reflection aqui na Alura:
            // Curso de 'Metaprogramação com PHP: API de Reflection': https://cursos.alura.com.br/course/metaprogramacao-php-api-reflection
    // $controller = new $controllerClass($repository); // Antes
    $controller = $diContainer->get($controllerClass);
} else {
    $controller = new Error404Controller();
}

$psr17Factory = new Psr17Factory;

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$request = $creator->fromGlobals();

/** @var RequestHandlerInterface $controller */
$response = $controller->handle($request);

http_response_code($response->getStatusCode());
foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {  
        header (sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();

// ------------------------------------

// Antes de termos o arquivo routes.php:
// if (!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER['PATH_INFO'] === '/') {
//     $controller = new VideoListController($repository);
//     // $controller->processRequest();
// } elseif ($_SERVER['PATH_INFO'] === '/novo-video') {
//     if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//         $controller = new VideoFormController($repository);
//         // $controller->processRequest();
//     } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         $controller = new NewVideoController($repository);
//         // $controller->processRequest();
//         // require_once __DIR__.'/../novo-video.php';
//     }
// } elseif ($_SERVER['PATH_INFO'] === '/edita-video') {
//     if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//         $controller = new VideoFormController($repository);
//         // $controller->processRequest();
//     } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         $controller = new EditVideoController($repository);
//         // $controller->processRequest();
//         // require_once __DIR__.'/../edita-video.php';
//     }
// } elseif ($_SERVER['PATH_INFO'] === '/remover-video') {
//     $controller = new DeleteVideoController($repository);
//     // $controller->processRequest();
//     // require_once __DIR__.'/../remover-video.php';
// } elseif ($_SERVER['PATH_INFO'] === '/sobre-mvc') {
//     require_once __DIR__.'/../views/sobre-mvc.php';
// } else {
//     $controller = new Error404Controller();
//     // $controller->processRequest();
//     // http_response_code(404);
// }
// /**
//  * @var Controller $controller;
//  */
// $controller->processRequest(); // *NOTA: Como todos os controlles tem uma função com mesmo nome 'processRequest()'. Podemos chamar ela apenas uma vez! fora do if <3
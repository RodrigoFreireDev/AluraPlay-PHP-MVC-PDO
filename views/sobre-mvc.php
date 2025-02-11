<?php

?><!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O que é MVC?</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #333;
        }
        img {
            width: 100%;
        }
        code {
            /* background: #eee; */
            padding: 5px;
            border-radius: 5px;
        }
        pre {
            background: #333;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/"><<< HOME</a>
        <h1>O que é MVC?</h1>
        <img src="./img/mvc.png" alt="Modelo">
        <p>MVC (Model-View-Controller) é um padrão de arquitetura de software que separa a aplicação em três camadas principais:</p>

        <p><strong>Model</strong> - Representa os dados e a lógica de negócios.</br></p>
        <img src="./img/modelo.png" alt="Modelo">
        <p><strong>View</strong> - Responsável pela interface com o usuário.</br></p>
        <img src="./img/view.png" alt="View">
        <p><strong>Controller</strong> - Gerencia a comunicação entre Model e View.</br></p>
        <img src="./img/controller.png" alt="Controller">

        <h2>Exemplo de MVC em PHP</h2>
        <p><strong>Model (arquivo: <code>Model.php</code>)</strong></p>
        <pre><code>
class Model {
    public function getData() {
        return "Olá, mundo do MVC!";
    }
}
        </code></pre>

        <p><strong>View (arquivo: <code>View.php</code>)</strong></p>
        <pre><code>
class View {
    public function render($data) {
        echo "&lt;h2&gt;" . $data . "&lt;/h2&gt;";
    }
}
        </code></pre>

        <p><strong>Controller (arquivo: <code>Controller.php</code>)</strong></p>
        <pre><code>
class Controller {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function show() {
        $data = $this->model->getData();
        $this->view->render($data);
    }
}
        </code></pre>

        <p><strong>Executando o código (arquivo: <code>index.php</code>)</strong></p>
        <pre><code>
require 'Model.php';
require 'View.php';
require 'Controller.php';

$model = new Model();
$view = new View();
$controller = new Controller($model, $view);
$controller->show();
        </code></pre>

        <p>Este é um exemplo básico que demonstra como o padrão MVC pode ser implementado em PHP.</p>
        <img src="./img/mvc.webp" alt="Modelo">

        <p>----------------------------------------------------------</p>

        <h3>Um pouco sobre outros padrões:</h3>
        <p>Embora o padrão apresentado pareça ser perfeito para a Web, não foi neste ambiente que o MVC nasceu. O MVC foi idealizado na década de 80, a partir do desenvolvimento de aplicações em Smalltalk.</p>

        <p>O que conhecemos hoje como MVC é na verdade uma adaptação deste padrão para a Web, por isso muitos o chamam de MVC 2 ou MVC Web.</p>

        <p>Após alguns questionamentos sobre a validade das decisões tomadas ao utilizar este padrão, surgiu uma nova proposta de como arquitetar nossas aplicações na Web, e este (bem mais) novo padrão é chamado de <a href="https://pmjones.io/adr/" target="_blank"> ADR (Action, Domain, Responder)</a>.</p>

        <p>O padrão ADR ainda não é tão adotado quanto o MVC, mas a leitura do mesmo vale a pena e nos faz questionar o que mais podemos melhorar em nossas escolhas de arquitetura.</p>
    
        <p>E sobre um padrão arquitetural muito famoso, o Clean Architecture, nós temos cursos aqui na Alura. A seguir está o link para o treinamento de Arquitetura Limpa com PHP:</p>

        <a href="https://cursos.alura.com.br/course/php-introducao-clean-achitecture" target="_blank">PHP e Clean Architecture: descomplicando arquitetura de software</a>


        <a href="/"><<< HOME</a>
    </div>
</body>
</html>

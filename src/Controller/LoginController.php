<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\FlashMessageTrait;
use Nyholm\Psr7\Response;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginController implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=aluraplay;charset=utf8mb4', 'root', 'Root@123');
    }

public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        $sql = 'SELECT * FROM users WHERE email = ?';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $email);
        $statement->execute();

        $userData = $statement->fetch(\PDO::FETCH_ASSOC);
        $correctPassword = password_verify($password, $userData['password'] ?? '');

if (!$correctPassword) {
    $this->addErrorMessage('Usuário ou senha inválidos');
    return new Response(302, ['Location' => '/login']);
}

        if (password_needs_rehash($userData['password'], PASSWORD_ARGON2ID)) {
            $statement = $this->pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
            $statement->bindValue(1, password_hash($password, PASSWORD_ARGON2ID));
            $statement->bindValue(2, $userData['id']);
            $statement->execute();
        }

        $_SESSION['logado'] = true;
        return new Response(302, ['Location' => '/']);
    }
}
// -------------------------------------------
// Rodrigo:
// namespace Alura\Mvc\Controller;

// use Alura\Mvc\Helper\FlashMessageTrait;
// use Nyholm\Psr7\Response;
// use PDO;
// use Psr\Http\Message\ResponseInterface;
// use Psr\Http\Message\ServerRequestInterface;

// class LoginController implements Controller
// {
//     use FlashMessageTrait;

//     private PDO $pdo;

//     public function __construct()
//     {
//         $this->pdo = new PDO('mysql:host=localhost;dbname=aluraplay;charset=utf8mb4', 'root', 'Root@123');
//     }

//     public function processRequest(ServerRequestInterface $request): ResponseInterface
//     {
//         // Buscar usuário pelo 'E-mail'(Motivo: é impossível busar por senha, pois vai estar incriptografada)
//         $parsedBody = $request->getParsedBody();
//         $email = filter_var($parsedBody['email'], FILTER_VALIDATE_EMAIL);
//         $password = filter_var($parsedBody['password']);

//         $sql = 'SELECT * FROM users WHERE email = ?';
//         $stmt = $this->pdo->prepare($sql);
//         $stmt->bindValue(1, $email);
//         $stmt->execute();

//         $userData = $stmt->fetch(PDO::FETCH_ASSOC);

//         // >>>>> Anti Timing Attack: ----------------------------------
//         // Criamo uma senha errada, para se caso o user não exista, o tempo de execução seja semelhamte ao quando existir pelo 'password_verify()'!
//         $storedPassword = password_hash(' ', PASSWORD_ARGON2I);
        
//         if ($userData) {
//             $storedPassword = $userData['password'];
//         }
//         // >>>>> Anti Timing Attack: ----------------------------------

//         // password_verify: Para comparar uma senha com o hash de senha armazenado no banco de dados, usamos a função password_verify(). Esta função 
//         // verifica o algoritmo usado, qual o vetor de inicialização, e analisa o processamento e, com isso, ela realiza a verificação.
//             // Essa verificação é feita em 'TEMPO CONSTANTE'(Termo) que é algo importante na area de segurança!
//         $correctPassword = password_verify($password, $storedPassword ?? ''); // ?? '': Se não existir, mande uma string vazia.

//         if (!$correctPassword) {
//             $this->addErrorMessage('Usuário ou senha inválidos!');
//             return new Response(302, [
//                 'Location' => '/login'
//             ]);
//         }

//         // password_needs_rehash($userData['password'], PASSWORD_ARGON2I) // : bool se a senha usa ou não a tecnologia de criptografia especificada(True se precisa e False se não precisa)!
//         if (password_needs_rehash($userData['password'], PASSWORD_ARGON2I)) {
//             $stmt = $this->pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
//             $stmt->bindValue(1, password_hash($password, PASSWORD_ARGON2I));
//             $stmt->bindValue(2, $userData['id']);
//             $stmt->execute();
//         }

//         $_SESSION['logado'] = true;
//         return new Response(302, [
//             'Location' => '/'
//         ]);

//         // if ($correctPassword) {
//         //     // Queremos informar que logado é igual a true ("verdadeiro"). Para armazenar isso, podemos usar uma super global do PHP chamada $_SESSION.
//         //     $_SESSION['logado'] = true;

//         //     header('Location: /');
//         //     return new Response(302, [
//         //         'Location' => '/'
//         //     ]);
//         // }
//         // } else {
//         //     $this->addErrorMessage('Usuário ou senha inválidos!');
//         //     return new Response(302, [
//         //         'Location' => '/login'
//         //     ]);
//         //     // header('Location: /login?sucesso=0');// Antes
//         // }

//     }
// }
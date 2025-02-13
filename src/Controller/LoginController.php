<?php

namespace Alura\Mvc\Controller;

use PDO;

class LoginController implements Controller
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=aluraplay;charset=utf8mb4', 'root', 'Root@123');
    }

    public function processRequest(): void
    {
        // Buscar usuário pelo 'E-mail'(Motivo: é impossível busar por senha, pois vai estar incriptografada)

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        $sql = 'SELECT * FROM users WHERE email = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        // password_verify: Para comparar uma senha com o hash de senha armazenado no banco de dados, usamos a função password_verify(). Esta função 
        // verifica o algoritmo usado, qual o vetor de inicialização, e analisa o processamento e, com isso, ela realiza a verificação.
            // Essa verificação é feita em 'TEMPO CONSTANTE'(Termo) que é algo importante na area de segurança!
        $correctPassword = password_verify($password, $userData['password'] ?? ''); // ?? '': Se não existir, mande uma string vazia.

        if ($correctPassword) {
            // Queremos informar que logado é igual a true ("verdadeiro"). Para armazenar isso, podemos usar uma super global do PHP chamada $_SESSION.
            $_SESSION['logado'] = true;

            header('Location: /');
        } else {
            header('Location: /login?sucesso=0');
        }

    }
}
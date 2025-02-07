<!-- <?php
// http_response_code(404);
echo "AQUI 001";
exit;
?> -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página não encontrada | AluraPlay</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #121212;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .container {
            max-width: 600px;
        }
        h1 {
            font-size: 100px;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            margin-bottom: 30px;
        }
        .btn {
            background-color: #ff5722;
            color: white;
            padding: 12px 24px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }
        .btn:hover {
            background-color: #e64a19;
        }
        .animation {
            animation: float 1.5s infinite ease-in-out alternate;
        }
        @keyframes float {
            from {
                transform: translateY(0);
            }
            to {
                transform: translateY(-10px);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="animation">404</h1>
        <p>Ops! A página que você procura não foi encontrada.</p>
        <a href="/" class="btn">Voltar para a Home</a>
    </div>
</body>
</html>

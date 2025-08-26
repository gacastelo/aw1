<?php
session_start();
if (isset($_SESSION['logado'])) {
    header('Location: exibir.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descrição do site">
    <title>Area Login</title>
    <style>
        form {
            width: 50%;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            margin-top: 50px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="reset"] {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <main>
        <form action="processos/processar_login.php" method="post">
            <h1>Login</h1>  
            <label for="txt-email">E-mail</label>
            <input type="email" name="email" id="txt-email">
            <br>
            <label for="txt-senha">Senha</label>
            <input type="password" name="senha" id="txt-senha">
            <br>
            <button type="submit">Enviar</button>
            <button type="reset">Limpar</button>
        </form>
        <p style="text-align: center"><a href="cadastro.php"> Meu primero acesso</a></p>
    </main>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descrição do site">
    <title>Formulário de Contato</title>
    <style>
            form {
                width: 50%;
                margin: 0 auto;
                font-family: Arial, sans-serif;
            }
            label {
                display: block;
                margin-bottom: 10px;
            }
            input[type="text"],
            input[type="email"] {
                width: 100%;
                padding: 10px;
                font-size: 16px;
                margin-bottom: 20px;
            }
            textarea {
                width: 100%;
                height: 150px;
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
    <form action="processos/processamento.php" method="post">
        <h1>Formulário de Contato</h1>
        <label for="txt-nome">Nome</label>
        <input type="text" name="nome" id="nome" <?php if (isset($_POST['nome'])) echo $_POST['nome']; ?>>
        <br>
        <label for="txt-email">E-mail</label>
        <input type="email" name="email" id="txt-email" <?php if (isset($_POST['email'])) echo $_POST['email']; ?>>
        <br>
        <label for="txt-mensagem">Mensagem</label>
        <textarea name="mensagem" id="txt-mensagem" cols="30" rows="10"></textarea>
        <br>
        <label for="txt-senha">Senha</label>
        <input type="password" name="senha" id="txt-senha">
        
        <button type="submit">Enviar</button>
        <button type="reset">Limpar</button>
    </form>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descrição do site">
    <title>Area Login</title>
</head>
<body>
    <main>
        <form action="processos/processar_login.php" method="post">
            <label for="txt-email">E-mail</label>
            <input type="email" name="email" id="txt-email">
            <br>
            <label for="txt-senha">Senha</label>
            <input type="password" name="senha" id="txt-senha">
            <br>
            <button type="submit">Enviar</button>
            <button type="reset">Limpar</button>
        </form>
        <p><a href="cadastro.php"> Meu primero acesso</a></p>
    </main>
</body>
</html>
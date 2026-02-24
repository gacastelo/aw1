<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descrição do site">
    <title>Título</title>
</head>
<body>
    <?php 
    echo "Hello, World! Cadastro";
    ?>
    <form action="" method="post">
        <label for="username">Nome de Usuário:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descrição do site">
    <title>Título</title>
</head>
<body>
    <h1>Home</h1>
    <?php
    echo $_SESSION['user_id'] .' <br>';
    echo $_SESSION['username'].' <br>';
    echo $_SESSION['email'];
    ?>
</body>
</html>
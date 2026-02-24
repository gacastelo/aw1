<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num = $_POST['num'];
        $num2 = $_POST['num2'];
        
        for ($i = 1; $i <= $num2; $i++) {
            echo $num. '*' . $i . ' = ' . $num * $i . "<br>";
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descrição do site">
    <title>Título</title>
</head>
<body>
    <form method="post">
        <label for="">Digite um número para ser multiplicado: <input type="number" name="num"></label><br>
        <label for="">Até que numero deseja a tabuada?: <input type="number" name="num2"></label><br>
        <button type="submit">Enviar</button>
    </form>
    
</body>
</html>
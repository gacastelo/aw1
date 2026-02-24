<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $pessoa1 = $_POST['pessoa1'];
  $pessoa2 = $_POST['pessoa2'];
  $pessoa3 = $_POST['pessoa3'];
  $pessoa4 = $_POST['pessoa4'];
  $pessoa5 = $_POST['pessoa5'];

  $pessoas = [$pessoa1, $pessoa2, $pessoa3, $pessoa4, $pessoa5];

  $p_maior_altura = $pessoas[0];
  $p_menor_altura = $pessoas[0];
  $media_feminina = 0;
  $qnt_feminina = 0;
  $media = 0;

  foreach ($pessoas as $pessoa) {
    if ($pessoa['altura'] > $p_maior_altura['altura']) {
      $p_maior_altura = $pessoa;
    }
    if ($pessoa['altura'] < $p_menor_altura['altura']) {
      $p_menor_altura = $pessoa;
    }
    if ($pessoa['sexo'] == 'feminino' || $pessoa['sexo'] == 'F' || $pessoa['sexo'] == 'FEMININO' || $pessoa['sexo'] == 'f') {
      $media_feminina += $pessoa['altura'];
      $qnt_feminina++;
    }
    $media += $pessoa['altura'];
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
    <style>
      form{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 50px;
      }
      label{
        margin: 10px;
      }
      input{
        margin: 10px;
        padding: 10px;
      }
      button{
        margin: 10px;
        padding: 10px;
      }
    </style>
</head>
<body>
<form method="post">
    <label for="pessoa1">Pessoa 1</label>
    <input type="text" name="pessoa1[altura]" placeholder="altura em cm (180)" <?php if (isset($pessoa1['altura'])) echo 'value="' . $pessoa1['altura'] . '"'; ?>>
    <input type="text" name="pessoa1[sexo]" placeholder="feminino" <?php if (isset($pessoa1['sexo'])) echo 'value="' . $pessoa1['sexo'] . '"'; ?>>

    <label for="pessoa2">Pessoa 2</label>
    <input type="text" name="pessoa2[altura]" placeholder="altura em cm (180)" <?php if (isset($pessoa2['altura'])) echo 'value="' . $pessoa2['altura'] . '"'; ?>>
    <input type="text" name="pessoa2[sexo]" placeholder="feminino" <?php if (isset($pessoa2['sexo'])) echo 'value="' . $pessoa2['sexo'] . '"'; ?>>

    <label for="pessoa3">Pessoa 3</label>
    <input type="text" name="pessoa3[altura]" placeholder="altura em cm (180)" <?php if (isset($pessoa3['altura'])) echo 'value="' . $pessoa3['altura'] . '"'; ?>>
    <input type="text" name="pessoa3[sexo]" placeholder="masculino" <?php if (isset($pessoa3['sexo'])) echo 'value="' . $pessoa3['sexo'] . '"'; ?>>

    <label for="pessoa4">Pessoa 4</label>
    <input type="text" name="pessoa4[altura]" placeholder="altura em cm (180)" <?php if (isset($pessoa4['altura'])) echo 'value="' . $pessoa4['altura'] . '"'; ?>>
    <input type="text" name="pessoa4[sexo]" placeholder="masculino" <?php if (isset($pessoa4['sexo'])) echo 'value="' . $pessoa4['sexo'] . '"'; ?>>

    <label for="pessoa5">Pessoa 5</label>
    <input type="text" name="pessoa5[altura]" placeholder="altura em cm (180)" <?php if (isset($pessoa5['altura'])) echo 'value="' . $pessoa5['altura'] . '"'; ?>>
    <input type="text" name="pessoa5[sexo]" placeholder="feminino" <?php if (isset($pessoa5['sexo'])) echo 'value="' . $pessoa5['sexo'] . '"'; ?>>


  <button type="submit">Enviar</button>
</form>
  <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      echo '<div style="text-align: center; font-size: 20px; margin-top: 150px">';
      echo "A pessoa mais alta é: ". $p_maior_altura['altura'] ."cm.";
      echo "<br>A pessoa mais baixa é: ". $p_menor_altura['altura'] ."cm.";
      echo "<br>A altura média das mulheres é: ". $media_feminina / $qnt_feminina ."cm.";
      echo "<br>A altura média das pessoas é: ". $media / count($pessoas) ."cm.";
      echo '</div>';
    }
  
  ?>
</body>
</html>
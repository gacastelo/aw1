<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$array = $_POST['meuArray'];
$menor = $array[0];

echo '<div style="text-align: center; font-size: 20px; margin-top: 150px">';
for ($i = 0; $i < count($array); $i++) {
    
    if ($array[$i] < $menor) $menor = $array[$i];
}
echo "O menor número é: ". $menor .".";

for ($i = 0; $i < count($array); $i++){
    echo "<br> Posição ". $i ." = ". $array[$i]-$menor;
}
echo '</div>';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 50px;
        }
        input{
            margin: 10px;
            padding: 10px;
            width: 80px;
        }
        button{
            margin: 10px;
            padding: 10px;
        }
    </style>
</head>
<body>
<form method="post">
  <input type="text" name="meuArray[]" placeholder="0" value="0">
  <input type="text" name="meuArray[]" placeholder="1" value="1">
  <input type="text" name="meuArray[]" placeholder="2" value="2">
  <input type="text" name="meuArray[]" placeholder="3" value="3">
  <input type="text" name="meuArray[]" placeholder="4" value="4">
  <input type="text" name="meuArray[]" placeholder="5" value="5">
  <input type="text" name="meuArray[]" placeholder="6" value="6">
  <input type="text" name="meuArray[]" placeholder="7" value="7">
  <button type="submit">Enviar</button>
</form>
</body>
</html>

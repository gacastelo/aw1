<?php
$diretorio = $_SERVER['DOCUMENT_ROOT'];

// Verifica se o caminho existe e é um diretório
if (is_dir($diretorio)) {
    // Lista todos os itens no diretório
    $itens = scandir($diretorio);

    // Filtra apenas os diretórios
    $pastas = array_filter($itens, function($item) use ($diretorio) {
        return is_dir($diretorio . DIRECTORY_SEPARATOR . $item) && $item !== '.' && $item !== '..';
    });
    echo "<div class='large-12 columns'>";
    echo "<h2>Seus Projetos</h2>";
    echo "<div class='row' style='padding-left: 25px;'>";
    // Exibe as pastas encontradas
    foreach ($pastas as $pasta) {
        echo "<p><a href='" .DIRECTORY_SEPARATOR . $pasta . "'>" . $pasta . "</a>" . "</p>";
    }
} else {
    echo "O caminho informado não é um diretório válido.";
}
echo "</div></div>";

?>
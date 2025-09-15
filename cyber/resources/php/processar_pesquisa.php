<?php
date_default_timezone_set('America/Sao_Paulo');
$dados = json_decode(file_get_contents('../db/db.json'), true);
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../pesquisa.php");
    exit;
}

if ($_POST["vitima"] === "sim") {

    $sentimentos = isset($_POST['sentimento']) ? $_POST['sentimento'] : [];

    if (in_array("outro", $sentimentos) && !empty($_POST['sentimento_outro'])) {
        $outro = trim($_POST['sentimento_outro']);

        $sentimentos = array_filter($sentimentos, fn($sentimento) => $sentimento !== "outro");
        $sentimentos[] = strtolower($outro);
    }

    $_POST["sentimentos"] = $sentimentos;
    
    $nova_pesquisa = [
        'id' => count($dados),
        'vitima' => $_POST['vitima'],
        'onde' => $_POST['onde'],
        'tipo' => $_POST['tipo'],
        'frequencia' => $_POST['frequencia'],
        'sentimento' => $_POST['sentimentos'],
        'ajuda' => $_POST['ajuda'],
        'suporte' => $_POST['suporte'],
        'comentarios' => $_POST['comentarios'],
        'horario' => date('d-m-Y H:i:s')
    ];
} else {
    $nova_pesquisa = [
        'id' => count($dados),
        'vitima' => $_POST['vitima'],
        'onde' => null,
        'tipo' => null,
        'frequencia' => null,
        'sentimento' => null,
        'ajuda' => null,
        'suporte' => null,
        'comentarios' => $_POST['comentarios'],
        'horario' => date('d-m-Y H:i:s')
    ];
}

$dados[] = $nova_pesquisa;
# Tirei pq não pode DB, então não sei se pode salvar os arquivos em json(q não é muito um DB)
#file_put_contents("../db/db.json", json_encode($dados, JSON_PRETTY_PRINT));

header("Location: ../../pesquisa.php");
exit;
?>
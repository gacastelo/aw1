<?php 
require_once '../assets/php/class/User.php';
require_once '../assets/php/class/Filme.php';

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    header('Location: ../public/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $diretor = $_POST['diretor'] ?? '';
    $ano = $_POST['ano'] ?? '';
    $genero = $_POST['genero'] ?? '';
    $link_imagem = $_POST['link_imagem'] ?? '';
    $avaliacao = $_POST['avaliacao'] ?? 0;
    $assistido = $_POST['assistido'] ?? false;
    $plataformas = $_POST['plataformas'] ?? '';
    $link_trailer = $_POST['link_trailer'] ?? '';
    $comentario = $_POST['comentario'] ?? '';

    $novo_filme = new Filme($titulo, $ano, $diretor, $genero, $link_imagem, $avaliacao, $assistido, $plataformas, $link_trailer, $comentario);

    $username = $_SESSION['user']->username;
    $_SESSION['users'][$username]->addFilme($novo_filme);

    header('Location: ../public/user.php?user=' . urlencode($username));
    exit();
}
?>
<?php 
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SESSION["email"] != $_POST["email"] || $_SESSION["senha"] != $_POST["senha"]) {
        header("Location: ../login.php");
        exit();
    }
    $_SESSION["logado"] = [];
    $_SESSION["logado"]["nome"] = $_POST["nome"];
    $_SESSION["logado"]["email"] = $_POST["email"];
    $_SESSION["logado"]["senha"] = $_POST["senha"];
    header("Location: ../dashboard.php");
    exit();
}
?>
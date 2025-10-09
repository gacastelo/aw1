<?php

abstract class AbstractController
{
    protected PDO $db; 
    

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    protected function render(string $viewPath, array $data = []): void
    {
        extract($data); 
        $debug = __DIR__ . "../View/{$viewPath}.php";
        echo "{$debug}";
        require __DIR__ . "../View/{$viewPath}.php";
    }


    public function flash(string $key, string $message): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['flash_messages'][$key] = $message;
    }

    public function redirect(string $path): void
    {
        header("Location: $path");
        exit();
    }
}
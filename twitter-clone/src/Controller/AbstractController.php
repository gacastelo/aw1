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
        require __DIR__ . "/../View/{$viewPath}.php";
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

    public function isLoggedIn(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    }

    public function getCurrentUserId(): ?int
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['user_id'] ?? null;
    }

    public function getCurrentUser(): ?User
    {
        if (!$this->isLoggedIn()) {
            return null;
        }

        $userId = $this->getCurrentUserId();
        $userRepo = new UserRepository($this->db);
        return $userRepo->findById($userId);
    }
}
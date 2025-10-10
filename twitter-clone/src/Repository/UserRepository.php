<?php

class UserRepository
{
    private PDO $db; 

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function save(User $user): bool
    {
        // Repare que vou passar o HASH da senha, e não a senha em texto puro! PQ aprendi da primeira vez kkkkk
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password_hash, created_at) VALUES (:user, :email, :hash, :created_at)");
        
        return $stmt->execute([
            ':user' => $user->__get('username'),
            ':email' => $user->__get('email'),
            ':hash' => $user->__get('password_hash'),
            ':created_at' => $user->__get('createdAt')->format('Y-m-d H:i:s')
        ]);
    }
    
    public function findByEmail(string $email): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }
        
        return new User(
            $data['username'],
            $data['email'],
            $data['password_hash'], // O hash do DB
            $data['id']
        );
    }

    public function findById(int $id): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }
        
        return new User(
            $data['username'],
            $data['email'],
            $data['password_hash'], // O hash do DB
            $data['id']
        );
    }
}
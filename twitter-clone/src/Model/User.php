<?php

class User
{
    private ?int $id;
    private string $username;
    private string $email;
    private string $password_hash; // Armazenaremos apenas o hash da senha, não a senha em texto puro
    private DateTime $createdAt;

    private array $hashtags_preferidas;

    public function __construct(string $username, string $email, string $password_hash, ?int $id = null)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("O e-mail fornecido é inválido.");
        }
        
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password_hash = $password_hash;
        $this->createdAt = new DateTime();
        $this->hashtags_preferidas = [];
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password_hash);
    }

    public function __get($atribute) {
        return $this->$atribute;
    }

    public function __set($atribute, $value) {
        $this->$atribute = $value;
    }

    public function addHashtagPreferida(string $hashtag){
        if (!in_array($hashtag, $this->hashtags_preferidas)) {
            $this->hashtags_preferidas[] = $hashtag;
        }
    }

    public function removeHashtagPreferida(string $hashtag){
        $index = array_search($hashtag, $this->hashtags_preferidas);
        if ($index !== false) {
            unset($this->hashtags_preferidas[$index]);
            // Reindexa o array para manter a sequência
            $this->hashtags_preferidas = array_values($this->hashtags_preferidas);
        }
    }
}
<?php
// src/Model/Post.php

class Post
{
    private ?int $id;
    private int $userId;
    private string $content;
    private ?int $replyToId; // Pode ser NULL se não for uma resposta
    private int $likeCount;
    private int $replyCount;
    private DateTime $createdAt;

    private array $hashtags;

    public function __construct(
        int $userId,
        string $content,
        ?int $replyToId = null,
        ?int $id = null,
        int $likeCount = 0,
        int $replyCount = 0,
        ?DateTime $createdAt = null,
        ?array $hashtags = []
    ) {
        // 1. Regra de Validação: O Model garante o limite de 1 a 280 caracteres
        $trimmedContent = trim($content);
        if (mb_strlen($trimmedContent) < 1 || mb_strlen($trimmedContent) > 280) {
            throw new InvalidArgumentException("O post deve ter entre 1 e 280 caracteres.");
        }
        
        $this->id = $id;
        $this->userId = $userId;
        $this->content = $trimmedContent;
        $this->replyToId = $replyToId;
        $this->likeCount = $likeCount;
        $this->replyCount = $replyCount;
        // Se for um Post novo, define a data de criação agora
        $this->createdAt = $createdAt ?? new DateTime(); 
        $this->hashtags = $hashtags ?? $this->extractHashtags($content);
    }

     public function __get($atribute) {
        return $this->$atribute;
    }
    
    public function isReply(): bool
    {
        // Regra: É uma resposta se o replyToId estiver preenchido.
        return $this->replyToId !== null;
    }
    
    // Métodos para o Model se auto-atualizar (necessário para os contadores)
    public function incrementLikeCount(): void
    {
        $this->likeCount++;
    }
    public function decrementLikeCount(): void
    {
        if ($this->likeCount > 0) {
            $this->likeCount--;
        }
    }
    public function incrementReplyCount(): void
    {
        $this->replyCount++;
    }
    public function decrementReplyCount(): void
    {
        if ($this->replyCount > 0) {
            $this->replyCount--;
        }
    }
    public function extractHashtags(string $content): array
    {
        $regex = '/#([a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*)/u';
        preg_match_all($regex, $content, $matches);
        $hashtags = array_unique($matches[1] ?? []);
        return $hashtags; 
    }
}
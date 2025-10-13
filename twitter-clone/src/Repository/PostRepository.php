<?php
// src/Repository/PostRepository.php

class PostRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function save(Post $post): bool
    {
        $sql = "INSERT INTO posts (user_id, content, reply_to_id) 
                VALUES (:user_id, :content, :reply_to_id)";

        $stmt = $this->db->prepare($sql);
        
        $result = $stmt->execute([
            ':user_id' => $post->__get('userId'),
            ':content' => $post->__get('content'),
            
            // Passa NULL se não for uma resposta a um post
            ':reply_to_id' => $post->__get('replyToId') 
        ]);

        if ($result && $post->isReply()) {
            $this->incrementReplyCount($post->__get('replyToId'));
        }

        return $result;
    }

    // Busca todos os posts de um usuário (Perfil)
    public function findAllByUserId(int $user_id): array
    {
        // Sugestão: Adicionar JOIN para trazer o nome do autor (embora aqui seja implícito)
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE user_id = :user_id ORDER BY created_at DESC");
        $stmt->execute([':user_id' => $user_id]);
        $postsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $posts = [];
        foreach ($postsData as $data) {
            $posts[] = new Post(
                $data['user_id'],
                $data['content'],
                $data['reply_to_id'],
                $data['id'],
                $data['like_count'],
                $data['reply_count'],
                new DateTime($data['created_at'])
            );
        }
        return $posts;
    }

    // Busca um Post por ID
    public function findById(int $id): ?Post
    {
        // O ideal aqui é fazer um JOIN com users para trazer os dados do autor (username, display_name)
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        // 4. Construtor completo do Model
        return new Post(
            $data['user_id'],
            $data['content'],
            $data['reply_to_id'],
            $data['id'],
            $data['like_count'], 
            $data['reply_count'],
            new DateTime($data['created_at'])
        );
    }

    public function findRepliesByPostId(int $post_id): array
    {
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE reply_to_id = :post_id ORDER BY created_at ASC");
        $stmt->execute([':post_id' => $post_id]);
        $repliesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $replies = [];
        foreach ($repliesData as $data) {
            $replies[] = new Post(
                $data['user_id'],
                $data['content'],
                $data['reply_to_id'],
                $data['id'],
                $data['like_count'],
                $data['reply_count'],
                new DateTime($data['created_at'])
            );
        }
        return $replies;
    }
    
    // Método auxiliar (Privado) para o save()
    private function incrementReplyCount(int $postId): void
    {
        $sql = "UPDATE posts SET reply_count = reply_count + 1 WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $postId]);
    }
    
    // Método para Curtir
    public function incrementLikeCount(int $postId): bool
    {
        // Nome alterado para refletir a ação (incrementar)
        $stmt = $this->db->prepare("UPDATE posts SET like_count = like_count + 1 WHERE id = :id");
        return $stmt->execute([':id' => $postId]);
    }

    // Método para Descurtir
    public function decrementLikeCount(int $postId): bool
    {
        // Nome alterado e SQL ajustado para 'like_count'
        $stmt = $this->db->prepare("UPDATE posts SET like_count = GREATEST(like_count - 1, 0) WHERE id = :id");
        return $stmt->execute([':id' => $postId]);
    }
    
    // Método para Deletar
    public function destroy(int $id): bool
    {
        // O DELETE automático (CASCADE) cuidará das respostas e likes!
        $stmt = $this->db->prepare("DELETE FROM posts WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

 public function getTimelinePosts(int $currentUserId, int $limit = 20, int $offset = 0): array
    {
        $sql = "
            SELECT 
                p.id AS post_id, p.content, p.created_at AS post_created_at, 
                p.like_count, p.reply_count,
                u.id AS user_id, u.username, u.bio
            FROM 
                posts p
            JOIN 
                users u ON p.user_id = u.id
            LEFT JOIN 
                follows f ON p.user_id = f.followed_id AND f.follower_id = :current_user_id
            WHERE 
                p.user_id = :current_user_id
                OR f.follower_id IS NOT NULL
            ORDER BY 
                p.created_at DESC
            LIMIT :limit OFFSET :offset
        ";

        $stmt = $this->db->prepare($sql);
        
        $stmt->bindValue(':current_user_id', $currentUserId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
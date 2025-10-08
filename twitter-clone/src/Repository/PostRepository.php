<?php
class PostRepository
{
    private $db;
    public function __construct(PDO $db){
        $this->db = $db;
    }

    public function save(Post $post): bool{
        $stmt = $this->db->prepare("INSERT INTO posts (user_id, content, created_at) VALUES (:user_id, :content, :created_at)");
        return $stmt->execute([
            ':user_id' => $post->__get('user_id'),
            ':content' => $post->__get('content'),
            ':created_at' => $post->__get('createdAt')->format('Y-m-d H:i:s')
        ]);
    }

    public function findAllByUserId(int $user_id): array{
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE user_id = :user_id ORDER BY created_at DESC");
        $stmt->execute([':user_id' => $user_id]);
        $postsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $posts = [];
        foreach ($postsData as $data) {
            $posts[] = new Post(
                $data['user_id'],
                $data['content'],
                $data['id'],
                new DateTime($data['created_at'])
            );
        }
        return $posts;
    }

    public function findById(int $id): ?Post{
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return new Post(
            $data['user_id'],
            $data['content'],
            $data['id'],
            new DateTime($data['created_at'])
        );
    }
}
?>
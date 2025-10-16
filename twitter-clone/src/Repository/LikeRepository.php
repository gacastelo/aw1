<?php
class LikeRepository
{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function findAllByPostId($post_id) {
        $stmt = $this->db->prepare("SELECT * FROM likes WHERE post_id = :post_id");
        $stmt->execute(['post_id' => $post_id]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Like');
    }

public function toggleLike($user_id, $post_id)
{
    $stmt = $this->db->prepare("SELECT * FROM likes WHERE user_id = :user_id AND post_id = :post_id");
    $stmt->execute(['user_id' => $user_id, 'post_id' => $post_id]);
    $like = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($like) {
        $stmt = $this->db->prepare("DELETE FROM likes WHERE user_id = :user_id AND post_id = :post_id");
        $stmt->execute(['user_id' => $user_id, 'post_id' => $post_id]);

        $stmt = $this->db->prepare("UPDATE posts SET like_count = GREATEST(like_count - 1, 0) WHERE id = :id");
        $stmt->execute(['id' => $post_id]);

        return false;
    } else {
        $stmt = $this->db->prepare("INSERT INTO likes (user_id, post_id, created_at) VALUES (:user_id, :post_id, NOW())");
        $stmt->execute(['user_id' => $user_id, 'post_id' => $post_id]);

        $stmt = $this->db->prepare("UPDATE posts SET like_count = like_count + 1 WHERE id = :id");
        $stmt->execute(['id' => $post_id]);

        return true;
    }
}


    public function countLikes($post_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as like_count FROM likes WHERE post_id = :post_id");
        $stmt->execute(['post_id' => $post_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['like_count'] : 0;
    }

    public function isPostLikedByUser($post_id, $user_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM likes WHERE post_id = :post_id AND user_id = :user_id");
        $stmt->execute(['post_id' => $post_id, 'user_id' => $user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result && $result['count'] > 0;
    }
}
?>
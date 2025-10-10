<?php
class FollowRepository
{
    public function __construct(private PDO $db)
    {
        $this->db = $db;
    }

    public function follow(int $follower_id, int $followed_id): bool
    {
        $stmt = $this->db->prepare("INSERT IGNORE INTO follows (follower_id, followed_id) VALUES (:follower_id, :followed_id)");
        return $stmt->execute(['follower_id' => $follower_id, 'followed_id' => $followed_id]);
    }

    public function unfollow(int $follower_id, int $followed_id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM follows WHERE follower_id = :follower_id AND followed_id = :followed_id");
        return $stmt->execute(['follower_id' => $follower_id, 'followed_id' => $followed_id]);
    }

    public function isFollowing(int $follower_id, int $followed_id): bool
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM follows WHERE follower_id = :follower_id AND followed_id = :followed_id");
        $stmt->execute(['follower_id' => $follower_id, 'followed_id' => $followed_id]);
        return $stmt->fetchColumn() > 0;
    }

    public function getFollowers(int $user_id): array
    {
        $stmt = $this->db->prepare("SELECT follower_id FROM follows WHERE followed_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getFollowing(int $user_id): array
    {
        $stmt = $this->db->prepare("SELECT followed_id FROM follows WHERE follower_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getFollowersCount(int $user_id): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM follows WHERE followed_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        return (int)$stmt->fetchColumn();
    }

    public function getFollowingCount(int $user_id): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM follows WHERE follower_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        return (int)$stmt->fetchColumn();
    }
}
?>
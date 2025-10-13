<?php 
class TrendingRepository
{
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function save(Trending $trending): bool
    {
        $stmt = $this->db->prepare("INSERT INTO trendings (hashtag, posts_count) VALUES (:hashtag, :posts_count)");
        
        return $stmt->execute([
            ':hashtag' => $trending->__get('hashtag'),
            ':posts_count' => $trending->__get('postsCount')
        ]);
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM trendings ORDER BY posts_count DESC");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $trendings = [];
        foreach ($data as $row) {
            $trendings[] = new Trending(
                $row['id'],
                $row['hashtag'],
                $row['posts_count']
            );
        }

        return $trendings;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM trendings WHERE id = :id LIMIT 1");
        return $stmt->execute([':id' => $id]);
    }

    public function incrementPostsCount(string $hashtag): bool
    {
        $stmt = $this->db->prepare("UPDATE trendings SET posts_count = posts_count + 1 WHERE hashtag = :hashtag");
        return $stmt->execute([':hashtag' => $hashtag]);
    }

    public function findByHashtag(string $hashtag): ?Trending
    {
        $stmt = $this->db->prepare("SELECT * FROM trendings WHERE hashtag = :hashtag LIMIT 1");
        $stmt->execute([':hashtag' => $hashtag]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }
        
        return new Trending(
            $data['id'],
            $data['hashtag'],
            $data['posts_count']
        );
    }

    public function getAllHashtags(): array
    {
        $stmt = $this->db->query("SELECT hashtag FROM trendings");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_column($data, 'hashtag');
    }
}
?>
<?php
class Trending
{
    public ?int $id;
    public string $hashtag;
    public int $postsCount;
    public DateTime $createdAt;

    public function __construct(string $hashtag, int $postsCount, ?DateTime $createdAt = null, ?int $id = null)
    {
        $this->id = $id;
        $this->hashtag = $hashtag;
        $this->postsCount = $postsCount;
        $this->createdAt = $createdAt ?? new DateTime();
    }

    public function __get($atribute) {
        return $this->$atribute;
    }
}
?>
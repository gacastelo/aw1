<?php
class Like
{
    public ?int $id;
    public int $user_id;
    public int $post_id;
    public DateTime $created_at;

    public function __construct(int $user_id, int $post_id, ?int $id, ?DateTime $created_at) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->post_id = $post_id;
        $this->created_at = $created_at;
    }

    public function __get($attribute) {
        return $this->$attribute;
    }
}
?>
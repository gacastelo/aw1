<?php 

class Post
{
    private ?int $id;
    private int $user_id;
    private string $content;
    private DateTime $createdAt;

    public function __construct(int $user_id, string $content, ?int $id = null, ?DateTime $createdAt = null)
    {
        if (strlen($content) > 280) {
            throw new InvalidArgumentException("O conteúdo do post não pode exceder 280 caracteres.");
        }

        $this->user_id = $user_id;
        $this->content = $content;
        $this->id = $id;
        $this->createdAt = $createdAt ?? new DateTime();
    }

    public function __get($atribute) {
        return $this->$atribute;
    }
}

?>
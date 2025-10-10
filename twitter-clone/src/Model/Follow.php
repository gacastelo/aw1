<?php
class Follows
{
    public $id;
    public $follower_id;
    public $followed_id;

    public function __construct($id, $follower_id, $followed_id)
    {
        $this->id = $id;
        $this->follower_id = $follower_id;
        $this->followed_id = $followed_id;
    }

    public function __get($atribute) {
        return $this->$atribute;
    }
}


?>
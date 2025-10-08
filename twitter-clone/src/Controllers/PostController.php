<?php 
class PostController extends AbstractController
{
    public function store($user_id, $content)
    {
        try {
            $post = new Post($user_id, $content);
            $postRepository = new PostRepository($this->db);
            $postRepository->save($post);
            $this->flash('success', 'Post criado com sucesso!');
        } catch (InvalidArgumentException $e) {
            $this->flash('error', $e->getMessage());
        }
        $this->redirect('/home');
    }

    public function listByUser(int $user_id): array
    {
        $postRepository = new PostRepository($this->db);
        return $postRepository->findAllByUserId($user_id);
    }

    public function view(int $post_id): void
    {
        $postRepository = new PostRepository($this->db);
        $post = $postRepository->findById($post_id);
        $this->render('post', ['post' => $post]);
    }
}
?>
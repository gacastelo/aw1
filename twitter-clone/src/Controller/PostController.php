<?php 
class PostController extends AbstractController
{
    public function store()
    {

        if (!$this->isLoggedIn()) {
            $this->flash('error', 'Você precisa estar logado para postar.');
            $this->redirect('/login');
            return;
        }

        $userId = $_SESSION['user_id'];
        $content = $_POST['content'] ?? '';
        $replyToId = $_POST['reply_to_id'] ?? null;
        
        $replyToId = is_numeric($replyToId) ? (int)$replyToId : null;

        try {
            $post = new Post($userId, $content, $replyToId);
            

            $postRepository = new PostRepository($this->db);
            $postRepository->save($post);
            
            $this->flash('success', $post->isReply() ? 'Resposta publicada!' : 'Post criado com sucesso!');
            
        } catch (InvalidArgumentException $e) {
            $this->flash('error', $e->getMessage());
            
        } catch (Exception $e) {
            error_log("PostController Error: " . $e->getMessage());
            $this->flash('error', 'Ocorreu um erro interno ao publicar.');
        }

        $this->redirect($replyToId ? "/post/{$replyToId}" : '/home');
    }

    public function showProfilePosts(int $user_id): void
    {
        $postRepository = new PostRepository($this->db);
        
        $posts = $postRepository->findAllByUserId($user_id); 
        
        $this->render('profile', [
            'author_id' => $user_id,
            'posts' => $posts,
        ]);
    }

    public function view(int $post_id): void
    {
        $postRepository = new PostRepository($this->db);
        
        $postData = $postRepository->findById($post_id);

        if (!$postData) {
            http_response_code(404);
            $this->render('404');
            return;
        }
        
        $replies = $postRepository->findRepliesByPostId($post_id);

        $this->render('post_detail', [
            'post' => $postData,
            'replies' => $replies
        ]);
    }
}
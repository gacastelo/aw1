<?php 
include_once __DIR__ . '/../Repository/LikeRepository.php';

class LikeController extends AbstractController 
{

    public function togglelikePost($post_id) 
    {
        header('Content-Type: application/json');

        if (!$this->isLoggedIn()) {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Você precisa estar logado para curtir posts.']);
            return;
        }
        
        try {
            $currentUserId = $this->getCurrentUserId();
            $likeRepository = new LikeRepository($this->db);
            
            $isLiked = $likeRepository->toggleLike($currentUserId, $post_id);
            
            http_response_code(200);
            echo json_encode([
                'success' => true, 
                'action' => $isLiked ? 'liked' : 'unliked',
                'message' => 'Like alternado com sucesso.',
                'new_like_count' => $likeRepository->countLikes($post_id) 
            ]);

        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Erro interno ao processar o like.', 'error_details' => $e->getMessage()]);
        }
    }

}
?>
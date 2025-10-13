<?php
include_once __DIR__ . '/../Model/User.php';
include_once __DIR__ . '/../Repository/UserRepository.php';
include_once __DIR__ . '/../Repository/PostRepository.php';
include_once __DIR__ . '/../Repository/FollowRepository.php';
class ProfileController extends AbstractController
{
    public function show(int $userId): void
    {
        $userRepo = new UserRepository($this->db);
        $postRepo = new PostRepository($this->db);
        $followRepo = new FollowRepository($this->db);

        $profileUser = $userRepo->findById($userId);

        if (!$profileUser) {
            http_response_code(404);
            $this->render('404');
            return;
        }

        $posts = $postRepo->findAllByUserId($userId);
        
        $followerCount = $followRepo->getFollowersCount($userId);
        $followingCount = $followRepo->getFollowingCount($userId);
        
        $isFollowing = false;

        $currentUserId = $this->getCurrentUserId(); // Esse helper pega $_SESSION['user_id']
        
        if ($this->isLoggedIn() && $currentUserId !== $userId) {
            $isFollowing = $followRepo->isFollowing($currentUserId, $userId);
        }

        $this->render('profile', [
            'profileUser' => $profileUser,
            'posts' => $posts,
            'followerCount' => $followerCount,
            'followingCount' => $followingCount,
            'isFollowing' => $isFollowing,
            'isOwner' => $this->isLoggedIn() && $currentUserId === $userId,
        ]);
    }

    public function followUser(int $followedId)
    {
        if (!$this->isLoggedIn()) {
            $this->flash('error', 'Você precisa estar logado para seguir.');
            $this->redirect('/login');
            return;
        }

        $currentUserId = $this->getCurrentUserId();
        
        if ($currentUserId === $followedId) {
            $this->flash('error', 'Você não pode seguir a si mesmo.');
            $this->redirect("/profile/{$followedId}");
            return;
        }

        $followRepo = new FollowRepository($this->db);
        $success = $followRepo->follow($currentUserId, $followedId);
        
        if ($success) {
            $this->flash('success', 'Começou a seguir!');
        } else {
             // Pode ser que o usuário já estivesse seguindo (INSERT IGNORE)
             $this->flash('info', 'Você já segue este usuário.'); 
        }

        $this->redirect("/profile/{$followedId}");
    }

    public function unfollowUser(int $followedId)
    {
        if (!$this->isLoggedIn()) {
            $this->flash('error', 'Você precisa estar logado.');
            $this->redirect('/login');
            return;
        }

        $currentUserId = $this->getCurrentUserId();
        $followRepo = new FollowRepository($this->db);
        
        $success = $followRepo->unfollow($currentUserId, $followedId);
        
        if ($success) {
            $this->flash('success', 'Parou de seguir.');
        } else {
            $this->flash('error', 'Erro ao processar a solicitação.');
        }

        $this->redirect("/profile/{$followedId}");
    }
}
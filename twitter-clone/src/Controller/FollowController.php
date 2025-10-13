<?php 
class FollowController extends AbstractController 
{
    public function follow($user_id) 
    {
        if (!$this->isLoggedIn()) {
            $this->flash('error', 'Você precisa estar logado para seguir usuários.');
            $this->redirect('/login');
            return;
        }
        $currentUserId = $this->getCurrentUserId();
        if ($currentUserId === $user_id) {
            $this->flash('error', 'Você não pode seguir a si mesmo.');
            return;
        }
        $followRepository = new FollowRepository($this->db);
        $followRepository->follow($currentUserId,$user_id);
    }
    public function unfollow($user_id) 
    {
        if (!$this->isLoggedIn()) {
            $this->flash('error', 'Você precisa estar logado para deixar de seguir usuários.');
            $this->redirect('/login');
            return;
        }
        $currentUserId = $this->getCurrentUserId();
        if ($currentUserId === $user_id) {
            $this->flash('error', 'Você não pode deixar de seguir a si mesmo.');
            return;
        }
        $followRepository = new FollowRepository($this->db);
        $followRepository->unfollow($currentUserId,$user_id);
    }

    public function showFollowers($user_id) 
    {
        if (!$this->isLoggedIn()) {
            $this->flash('error', 'Você precisa estar logado para ver seguidores.');
            $this->redirect('/login');
            return;
        }
        $followRepository = new FollowRepository($this->db);
        $followers = $followRepository->getFollowers($user_id);
        $this->render('followers', ['followers' => $followers]);
    }

    public function showFollowing($user_id) 
    {
        if (!$this->isLoggedIn()) {
            $this->flash('error', 'Você precisa estar logado para ver quem está seguindo.');
            $this->redirect('/login');
            return;
        }
        $followRepository = new FollowRepository($this->db);
        $following = $followRepository->getFollowing($user_id);
        $this->render('following', ['following' => $following]);
    }
}
?>
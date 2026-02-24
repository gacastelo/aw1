<?php 
include_once __DIR__ . '/../Model/Trending.php';
include_once __DIR__ . '/../Repository/TrendingRepository.php';
class TrendingController extends AbstractController
{

    public function topTrends(): void
    {
        $trendingRepo = new TrendingRepository($this->db);
        $trendings = $trendingRepo->findAll();
        $this->render('trending/list', ['trendings' => $trendings]);
    }

    public function viewTrend($hashtag)
    {
        $trendingRepo = new TrendingRepository($this->db);
        $trending = $trendingRepo->findAllByHashtag($hashtag);
        $this->render('trending/trend', ['trending' => $trending, 'hashtag' => $hashtag]);
    }

    public function addTrend($hashtags)
    {
        $trendingRepo = new TrendingRepository($this->db);
        $existingTrending = $trendingRepo->getAllHashtags();
        foreach ($hashtags as $hashtag) {
            if (empty($hashtag)) {
                continue;
            }
            if (in_array($hashtag, $existingTrending)) {
                $trendingRepo->incrementPostsCount($hashtag);
            } else {
                $newTrending = new Trending($hashtag, 1);
                $trendingRepo->save($newTrending);
            }
        }
    }

    public function deleteTrend(int $id): void
    {
        $trendingRepo = new TrendingRepository($this->db);
        if ($trendingRepo->delete($id)) {
            $this->flash('success', 'Trending deletado com sucesso!');
        } else {
            $this->flash('error', 'Erro ao deletar trending. Tente novamente.');
        }
        exit();
    }

    public function istrendExpired(Trending $trending): bool
    {
        $now = new DateTime();
        $interval = $now->diff($trending->createdAt);
        return $interval->days >= 1;
    }
}
?>
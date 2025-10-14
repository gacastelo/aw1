<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descrição do site">
    <title>Título</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="container">
        <div class="profile-header">
            <h1>@<?= htmlspecialchars($profileUser->__get('username')) ?></h1>
            <p>Email: <?= htmlspecialchars($profileUser->__get('email')) ?></p>
            <p>Criado em: <?= $profileUser->__get('createdAt')->format('d/m/Y H:i') ?></p>
            <p>Seguidores: <?= $followerCount ?> | Seguindo: <?= $followingCount ?></p>

            <?php if (isset($isFollowing)): ?>
                <form method="POST" action="/aw1/twitter-clone/public/follow">
                    <input type="hidden" name="user_id" value="<?= $profileUser->__get('id') ?>">
                    <button type="submit" class="follow-btn <?= $isFollowing ? 'unfollow' : '' ?>">
                        <?= $isFollowing ? 'Deixar de seguir' : 'Seguir' ?>
                    </button>
                </form>
            <?php endif; ?>
        </div>

        <h2>Posts</h2>

        <?php if (empty($posts)): ?>
            <p>Este usuário ainda não publicou nada.</p>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <div class="post-card">
                    <div class="post-header">
                        <strong>@<?= htmlspecialchars($profileUser->__get('username')) ?></strong>
                        <span class="timestamp"><?= $post->createdAt->format('d/m/Y H:i') ?></span>
                    </div>
                    <div class="post-content">
                        <?php
                        $content = htmlspecialchars($post->content);
                        foreach ($post->hashtags as $tag) {
                            $content = str_replace(
                                "#$tag",
                                '<a class="hashtag" href="/aw1/twitter-clone/public/trending?hashtag=' . urlencode($tag) . '">#' . htmlspecialchars($tag) . '</a>',
                                $content
                            );
                        }
                        echo nl2br($content);
                        ?>
                    </div>
                    <div class="post-footer">
                        <span>❤️ <?= $post->likeCount ?></span>
                        <span>💬 <?= $post->replyCount ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>

</html>
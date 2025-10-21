<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descrição do site">
    <title>Título</title>
</head>
<body>
    <div class="container">
    <h1>Posts com a hashtag #<?= htmlspecialchars($hashtag) ?></h1>

    <?php if (empty($posts)): ?>
        <p>Nenhum post encontrado para essa hashtag.</p>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <div class="post-card">
                <div class="post-header">
                    <strong>@<?= htmlspecialchars($post->userId) ?></strong>
                    <span class="timestamp"><?= $post->createdAt->format('d/m/Y H:i') ?></span>
                </div>
                <div class="post-content">
                    <?php
                    // Converte hashtags em links clicáveis
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
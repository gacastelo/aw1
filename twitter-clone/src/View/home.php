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
    <div class="left">
        <h1>Home</h1>
        <ul>
            <li><a href="./profile?username=<?php echo $_SESSION['username']; ?>">Perfil</a></li>
            <li><a href="./logout">Sair</a></li>
        </ul>
    </div>

    <div class="mid">
        <div class="post-box">
            <h3>O que está acontecendo?</h3>
            <form id="postForm" action="./post" method="POST">

                <textarea name="content" id="postContent"
                    placeholder="Qual é a novidade, @<?php echo $_SESSION['username']; ?>?" maxlength="280"
                    required></textarea>

                <div class="post-actions">
                    <button type="submit" id="postButton">Postar</button>
                </div>
            </form>
        </div>
        <div class="timeline-container">

            <?php if (empty($posts)): ?>
                <p class="no-posts">Nenhum post para exibir. Comece a seguir algumas pessoas!</p>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <div class="post-card">

                        <div class="post-header">
                            <strong><a href="/profile?username=<?php echo htmlspecialchars($post['username']); ?>">
                                    @<?php echo htmlspecialchars($post['username']); ?>
                                </a></strong>
                            <span class="timestamp">
                                <?php echo date('d/m/Y H:i', strtotime($post['post_created_at'])); ?>
                            </span>
                        </div>

                        <p class="post-content">
                            <?php echo nl2br(htmlspecialchars($post['content'])); ?>
                        </p>

                        <div class="post-footer">
                            <span>❤️ <?php echo $post['like_count']; ?></span>
                            <span>💬 <?php echo $post['reply_count']; ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>

    <div class="right">
        <h1>Trendings</h1>
        <?php if (empty($trendingHashtags)): ?>
            <p class="no-trends">Nenhum trend para exibir.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($trendingHashtags as $trendingHashtag): ?>
                    <li><a
                            href="<?php echo "trends?hashtag=" . htmlspecialchars($trendingHashtag); ?>"><?php echo htmlspecialchars($trendingHashtag); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <script src="./assets/js/script.js"></script>
</body>

</html>
<?php
$modalId = 'movieModal-' . str_replace(' ', '-', strtolower($title));
?>

<div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" aria-labelledby="<?php echo $modalId; ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="<?php echo $modalId; ?>Label"><?php echo htmlspecialchars($title); ?> (<?php echo htmlspecialchars($year); ?>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="<?php echo htmlspecialchars($image_link); ?>" class="img-fluid rounded shadow-sm mb-3" alt="Pôster de <?php echo htmlspecialchars($title); ?>" style="max-height: 300px; object-fit: cover;">
                        
                        <p class="h4">
                            Avaliação: 
                            <span class="badge bg-warning text-dark">
                            <?php 
                    for ($i = 0; $i < $rating; $i++) {
                        echo "⭐";
                    }
                ?>
                            </span>
                        </p>
                        
                        <p class="h5">
                            Status: 
                            <span class="badge <?php echo $watched ? 'bg-success' : 'bg-secondary'; ?>">
                                <?php echo $watched ? 'Assistido' : 'Pendente'; ?>
                            </span>
                        </p>
                    </div>

                    <div class="col-md-8">
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item"><strong>Diretor:</strong> <?php echo htmlspecialchars($director); ?></li>
                            <li class="list-group-item"><strong>Gênero(s):</strong> <?php echo htmlspecialchars($genre); ?></li>
                            <li class="list-group-item"><strong>Plataformas:</strong> <?php echo htmlspecialchars($platforms); ?></li>
                        </ul>

                        <?php if (!empty($comment)): ?>
                            <h6 class="mt-3">Seu Comentário:</h6>
                            <p class="alert alert-info"><?php echo nl2br(htmlspecialchars($comment)); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($trailer_link)): ?>
                            <h6 class="mt-3">Trailer:</h6>
                            <div class="ratio ratio-16x9">
                                <?php
                                $embed_link = str_replace('watch?v=', 'embed/', htmlspecialchars($trailer_link));
                                ?>
                                <iframe src="<?php echo $embed_link; ?>" 
                                        title="Trailer do Filme" 
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen></iframe>
                            </div>
                        <?php else: ?>
                            <p class="text-muted mt-3">Link do trailer não fornecido.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
        </div>
    </div>
</div>

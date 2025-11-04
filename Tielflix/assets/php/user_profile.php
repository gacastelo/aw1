<div class="mb-5">
    <h2 class="display-5 mb-3 border-bottom pb-2">Detalhes do Perfil</h2>
    <?php
    echo "<p class='lead mb-0'><strong>Usuário:</strong> " . htmlspecialchars($user->username) . "</p>";
    echo "<p class='text-muted small'><strong>Membro Desde:</strong> " . htmlspecialchars($user->created_at) . "</p>";
    ?>

    <h3 class="h4 mt-5 mb-3 border-bottom pb-1">Lista de Filmes</h3>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

        <?php if ($is_owner): ?>
            <div class="col">
                <div class="card h-100 bg-light text-center border-dashed">
                    <div class="card-body d-flex align-items-center justify-content-center p-5">

                        <span class="btn btn-success btn-lg d-flex align-items-center justify-content-center"
                            id="btnAdicionar" data-bs-toggle="modal" data-bs-target="#addFilmeModal" style="width: 60px; 
                       height: 60px; 
                       border-radius: 50%; 
                       font-size: 3rem; 
                       padding: 0;">
                            <span style="line-height: 0; margin-top: -0.5rem">+</span>
                        </span>

                    </div>
                    <p class="text-muted small mb-3">Adicionar Novo Filme</p>
                </div>
            </div>
        <?php endif; ?>

        <?php
        if (empty($user->filmes)) {
            echo "<div class='col-12'><div class='alert alert-info mt-3' role='alert'>Este usuário ainda não adicionou filmes.</div></div>";
        }

        foreach ($user->filmes as $filme):
            $modalId = 'movieModal-' . str_replace(' ', '-', strtolower($filme->titulo));
            ?>
            <div class="col">
                <div onclick="openFilmeModal('<?php echo $modalId; ?>')" class="card h-100 shadow-sm movie-card"
                    style="cursor: pointer;">
                    <img src="<?= htmlspecialchars($filme->link_imagem) ?>"
                        alt="<?= htmlspecialchars($filme->titulo) ?> - <?= htmlspecialchars($filme->ano) ?> poster"
                        class="card-img-top" style="height: 250px; object-fit: cover;" />

                    <div class="card-body">
                        <h5 class="card-title h6 text-truncate mb-1"><?= htmlspecialchars($filme->titulo) ?></h5>
                        <p class="card-subtitle mb-2 text-muted small"><?= htmlspecialchars($filme->ano) ?></p>

                        <p class="card-text small mb-1">Direção: <?= htmlspecialchars($filme->diretor) ?></p>

                        <p class="card-text mb-0">Avaliação:
                            <?php
                            $avaliacao = (int) $filme->avaliacao;
                            for ($i = 0; $i < $avaliacao; $i++) {
                                echo "⭐";
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </div>

            <?php
            $filme->view();
        endforeach;
        ?>
    </div>
</div>

<script>
    function openFilmeModal(modalId) {
        const modal = new bootstrap.Modal(document.getElementById(modalId));
        modal.show();
    }
</script>
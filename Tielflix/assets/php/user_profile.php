<div>
    <h2>Profile Details</h2>
    <?php 
    echo "<p>Username: " . htmlspecialchars($user->username) . "</p>";
    echo "<p>Created At: " . htmlspecialchars($user->created_at) . "</p>";
    ?>

    <?php if ($is_owner){
        echo "<button type='button' class='btn btn-info' id='btnEditarPerfil'>Editar Perfil</button>";
    }
    ?>
    <div>
        <?php if ($is_owner){
            echo "
            <div><span id='btnAdicionar'>+</span></div>";
        }
        ?>
        <?php
        if (empty($user->filmes)) {
            echo "<p>Este usuário ainda não adicionou filmes.</p>";
        }
        foreach ($user->filmes as $filme) : 
            $modalId = 'movieModal-' . str_replace(' ', '-', strtolower($filme->titulo));
        ?>
            <div class="movie-card">
                <img onclick="openFilmeModal('<?php echo $modalId; ?>')" src="<?= htmlspecialchars($filme->link_imagem) ?>" alt="<?= htmlspecialchars($filme->titulo) ?> - <?= htmlspecialchars($filme->ano) ?> poster"/>
                
                <p class="movie-title"><?= htmlspecialchars($filme->titulo) ?>, <?= htmlspecialchars($filme->ano) ?></p>
                <p class="movie-director">Direção: <?= htmlspecialchars($filme->diretor) ?></p>
                
                <p class="movie-rating">Avaliação: 
                <?php 
                    $avaliacao = (int) $filme->avaliacao;
                    for ($i = 0; $i < $avaliacao; $i++) {
                        echo "⭐";
                    }
                ?>
                </p>
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

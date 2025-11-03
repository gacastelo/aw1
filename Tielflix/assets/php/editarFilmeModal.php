<?php
$modalId = 'editMovieModal-' . str_replace(' ', '-', strtolower($title));
$username = $_GET['user'] ?? '';
$is_owner = $username == $_SESSION['user']->username;

// Converte o booleano $watched para um valor de formulário '1' ou '0'
$watched_value = $watched ? '1' : '0';
?>

<div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" aria-labelledby="<?php echo $modalId; ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form action="../processos/editar_filme_processo.php" method="POST">
                
                <input type="hidden" name="filme_original_title" value="<?php echo htmlspecialchars($title); ?>">
                <!-- Pode adicionar um ID de filme oculto aqui se existir -->

                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="<?php echo $modalId; ?>Label">Editar Filme: <?php echo htmlspecialchars($title); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <div class="row">
                        
                        <!-- Coluna de Visualização (Não-Editável/Resumo) -->
                        <div class="col-md-4 text-center">
                            <img src="<?php echo htmlspecialchars($image_link); ?>" class="img-fluid rounded shadow-sm mb-3" alt="Pôster de <?php echo htmlspecialchars($title); ?>" style="max-height: 300px; object-fit: cover;">
                            
                            <p class="h4">
                                Avaliação Atual: 
                                <span class="badge text-dark">
                                <?php 
                                    for ($i = 0; $i < $rating; $i++) {
                                        echo "⭐";
                                    }
                                ?>
                                </span>
                            </p>
                            
                            <p class="h5">
                                Status Atual: 
                                <span class="badge <?php echo $watched ? 'bg-success' : 'bg-secondary'; ?>">
                                    <?php echo $watched ? 'Assistido' : 'Pendente'; ?>
                                </span>
                            </p>
                        </div>

                        <!-- Coluna do Formulário (Editável) -->
                        <div class="col-md-8">
                            
                            <!-- Título e Ano -->
                            <div class="row mb-3">
                                <div class="col-9">
                                    <label for="titulo" class="form-label">Título</label>
                                    <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($title); ?>" required>
                                </div>
                                <div class="col-3">
                                    <label for="ano" class="form-label">Ano</label>
                                    <input type="number" class="form-control" id="ano" name="ano" value="<?php echo htmlspecialchars($year); ?>" required>
                                </div>
                            </div>
                            
                            <!-- Diretor e Gênero -->
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="diretor" class="form-label">Diretor</label>
                                    <input type="text" class="form-control" id="diretor" name="diretor" value="<?php echo htmlspecialchars($director); ?>" required>
                                </div>
                                <div class="col-6">
                                    <label for="genero" class="form-label">Gênero(s)</label>
                                    <input type="text" class="form-control" id="genero" name="genero" value="<?php echo htmlspecialchars($genre); ?>">
                                </div>
                            </div>
                            
                            <!-- Plataformas e Link Imagem -->
                            <div class="mb-3">
                                <label for="plataformas" class="form-label">Plataformas</label>
                                <input type="text" class="form-control" id="plataformas" name="plataformas" value="<?php echo htmlspecialchars($platforms); ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label for="link_imagem" class="form-label">Link da Imagem (Poster)</label>
                                <input type="url" class="form-control" id="link_imagem" name="link_imagem" value="<?php echo htmlspecialchars($image_link); ?>">
                            </div>

                            <!-- Link Trailer -->
                            <div class="mb-3">
                                <label for="link_trailer" class="form-label">Link do Trailer (YouTube)</label>
                                <input type="url" class="form-control" id="link_trailer" name="link_trailer" value="<?php echo htmlspecialchars($trailer_link); ?>">
                            </div>
                            
                            <!-- Avaliação (Rating) e Status -->
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="avaliacao" class="form-label">Avaliação</label>
                                    <select class="form-select" id="avaliacao" name="avaliacao" required>
                                        <?php for ($i = 0; $i <= 5; $i++): ?>
                                            <option value="<?php echo $i; ?>" <?php echo ($rating == $i) ? 'selected' : ''; ?>>
                                                <?php echo str_repeat('⭐', $i); ?> (<?php echo $i; ?>)
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="status_assistido" class="form-label">Status</label>
                                    <select class="form-select" id="status_assistido" name="status_assistido" required>
                                        <option value="1" <?php echo ($watched_value == '1') ? 'selected' : ''; ?>>Assistido</option>
                                        <option value="0" <?php echo ($watched_value == '0') ? 'selected' : ''; ?>>Pendente</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Comentário -->
                            <div class="mb-3">
                                <label for="comentario" class="form-label">Seu Comentário</label>
                                <textarea class="form-control" id="comentario" name="comentario" rows="3"><?php echo htmlspecialchars($comment); ?></textarea>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <!-- Botão de Salvar Alterações -->
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-save"></i> Salvar Alterações
                    </button>->
                    <button type="button" class="btn btn-outline-danger me-auto">
                        <i class="bi bi-trash"></i> Excluir Filme
                    </button>
                    <!-- Botão Fechar -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>
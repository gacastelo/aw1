<div class="modal fade" id="addFilmeModal" tabindex="-1" aria-labelledby="addFilmeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="addFilmeModalLabel">Adicionar Filme Favorito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            
            <div class="modal-body">
                <form id="formAddFilme" method="post" action="../processos\addFilme.php">
                    
                    <h6 class="text-primary mb-3">1. Dados Essenciais do Filme</h6>
                    <div class="mb-3">
                        <label for="inputTitulo" class="form-label">Título do Filme <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="inputTitulo" name="titulo" placeholder="Ex: O Poderoso Chefão" required>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="inputAno" class="form-label">Ano de Lançamento <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="inputAno" name="ano" placeholder="Ex: 1972" required min="1888" max="<?= date('Y') + 1 ?>">
                        </div>
                        
                        <div class="col-md-8 mb-3">
                            <label for="inputDiretor" class="form-label">Diretor(a) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputDiretor" name="diretor" placeholder="Ex: Francis Ford Coppola" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="inputGenero" class="form-label">Gênero <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputGenero" name="genero" placeholder="Ex: Drama, Épico">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="inputLinkImagem" class="form-label">Link da Imagem/Pôster <span class="text-danger">*</span></label>
                            <input type="url" class="form-control" id="inputLinkImagem" name="link_imagem" placeholder="URL direta para o pôster" required>
                        </div>
                    </div>

                    <hr>
                    
                    <h6 class="text-primary mb-3">2. Sua Experiência e Avaliação <span class="text-danger">*</span></h6>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="inputNota" class="form-label">Sua Nota (1 a 5 Estrelas)</label>
                            <select class="form-select" id="inputNota" name="avaliacao" required>
                                <option value="" disabled selected>Escolha uma nota</option>
                                <option value="5">⭐⭐⭐⭐⭐ (Perfeito!)</option>
                                <option value="4">⭐⭐⭐⭐ (Muito Bom)</option>
                                <option value="3">⭐⭐⭐ (OK)</option>
                                <option value="2">⭐⭐ (Ruim)</option>
                                <option value="1">⭐ (Péssimo)</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3 d-flex align-items-center pt-md-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="inputAssistido" name="assistido" value="1" checked>
                                <label class="form-check-label fw-bold" for="inputAssistido">Já assisti a este filme? <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="inputPlataformas" class="form-label">Onde Assistir (Opcional)</label>
                            <input type="text" class="form-control" id="inputPlataformas" name="plataformas" placeholder="Ex: Netflix, DVD, Cinema">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="inputTrailer" class="form-label">Link do Trailer (Opcional)</label>
                            <input type="url" class="form-control" id="inputTrailer" name="link_trailer" placeholder="Cole o link do YouTube, se tiver">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="inputComentario" class="form-label">Seu Comentário/Opinião</label>
                        <textarea class="form-control" id="inputComentario" name="comentario" rows="3" placeholder="Por que este filme merece um lugar na sua lista?"></textarea>
                    </div>
                    <p><span class="text-danger">* Campos obrigatórios</span> </p>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="formAddFilme" class="btn btn-primary" id="btnSalvarFilme">Salvar Filme</button>
            </div>
            
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addFilmeModalElement = document.getElementById('addFilmeModal');

        const addFilmeModal = new bootstrap.Modal(addFilmeModalElement);

        const btnAdicionar = document.getElementById('btnAdicionar');

        if (btnAdicionar) {
            btnAdicionar.addEventListener('click', function () {
                const form = document.getElementById('formAddFilme');
                if (form) {
                    form.reset();
                }

                addFilmeModal.show();
            });
        }

    });
</script>
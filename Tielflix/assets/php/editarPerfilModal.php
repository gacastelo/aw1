<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Editar Informações do Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            
            <div class="modal-body">
                <form id="formEditProfile" method="POST" action="processos/profile_processo.php">
                    
                    <div class="mb-3">
                        <label for="inputUsername" class="form-label">Nome de Usuário (Username)</label>
                        <input type="text" class="form-control" id="inputUsername" name="username" readonly>
                        <div class="form-text">Seu Username não pode ser alterado no momento.</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="email" required placeholder="Digite seu novo email">
                        <div class="invalid-feedback">Por favor, insira um email válido.</div>
                    </div>

                    <hr>
                    
                    <div class="mb-3">
                        <label class="form-label">Segurança</label>
                        <p>Para alterar sua senha, use o botão abaixo.</p>
                        <button type="button" class="btn btn-warning btn-sm" id="btnChangePassword">Alterar Senha</button>
                    </div>

                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="formEditProfile" class="btn btn-primary" id="btnSaveProfile">Salvar Alterações</button>
            </div>
            
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    
    const editProfileModalElement = document.getElementById('editProfileModal');
    
    const editProfileModal = editProfileModalElement ? new bootstrap.Modal(editProfileModalElement) : null;
    
    const btnEditarPerfil = document.getElementById('btnEditarPerfil');

    if (btnEditarPerfil && editProfileModal) {
        btnEditarPerfil.addEventListener('click', function () {
            editProfileModal.show();
        });
    }

});
</script>
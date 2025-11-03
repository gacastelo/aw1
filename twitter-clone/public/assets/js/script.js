document.addEventListener('DOMContentLoaded', function() {
    const postTextarea = document.getElementById('postContent');
    const postButton = document.getElementById('postButton');
    const maxLength = 280;

    // Função que verifica o comprimento do texto
    function checkPostLength() {
        const currentLength = postTextarea.value.length;
        
        // Exemplo: desabilitar o botão se o texto for muito curto ou muito longo
        if (currentLength > 0 && currentLength <= maxLength) {
            postButton.disabled = false;
            // (Você pode adicionar lógica para mostrar um contador de caracteres aqui)
        } else {
            postButton.disabled = true;
        }
    }

    // Chama a função a cada tecla digitada
    postTextarea.addEventListener('input', checkPostLength);
    
    // Garante que o estado inicial está correto
    checkPostLength(); 
});
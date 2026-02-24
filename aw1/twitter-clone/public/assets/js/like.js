document.addEventListener('DOMContentLoaded', () => {
    const likeForms = document.querySelectorAll('.like-form');

    likeForms.forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); 
            
            const url = this.getAttribute('action');
            const postId = this.getAttribute('data-post-id');
            const button = this.querySelector('button[type="submit"]');
            const countSpan = this.querySelector('.like-count');

            button.disabled = true; 

            fetch(url, {
                method: 'POST'
            })
            .then(response => {
                if (!response.ok) {
                    if (response.status === 401) {
                        alert('Você precisa estar logado para curtir.');
                        window.location.href = './login'; 
                    }
                    return response.json().then(errorData => {
                        throw new Error(errorData.message || `Erro HTTP: ${response.status}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    if (data.action === 'liked') {
                        button.innerHTML = `❤️ <span class="like-count" data-post-id="${postId}">${data.new_like_count}</span>`;
                    } else {
                        button.innerHTML = `🖤 <span class="like-count" data-post-id="${postId}">${data.new_like_count}</span>`;
                    }
                } else {
                    alert('Erro na ação: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Falha na requisição:', error);
                alert('Ocorreu um erro inesperado. Tente novamente.');
            })
            .finally(() => {
                button.disabled = false;
            });
        });
    });
});
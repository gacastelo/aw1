const vitima = document.getElementById('vitima')
const ocultar = document.getElementById('hide')
const notRequired = document.querySelectorAll('.not-required')

vitima.addEventListener('change', function(){
    if (this.value == 'sim') {
        ocultar.classList.remove('hidden')
    } else {
        ocultar.classList.add('hidden')
        for (let i = 0; i < notRequired.length; i++) {
            notRequired[i].removeAttribute('required');
        }
    }
})

function sigma(){
    const nome = prompt("Area Restrita! Digite a senha para continuar:")
    if (nome == 'sigma') {
        location.href = 'exibir.php';
    }
}

function segredo(){
    location.href = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';
}
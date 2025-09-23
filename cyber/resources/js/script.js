const vitima = document.getElementById('vitima')
const ocultar = document.getElementById('hide')
const notRequired = document.querySelectorAll('.not-required')

let isPlaying = false;

vitima.addEventListener('change', function(){
    if (this.value == 'sim') {
        ocultar.classList.remove('hidden')
    } else {
        ocultar.classList.add('hidden')
        verificador = false
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

function segredo() {
    if (isPlaying) return;

    const audio = new Audio('resources/images/participantes/contemplem-o-magoo.mp3');
    isPlaying = true;

    audio.play().catch(err => console.error('Erro ao tocar:', err));

    audio.onended = () => {
        isPlaying = false;
    };
}



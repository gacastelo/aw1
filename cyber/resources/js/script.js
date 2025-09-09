const vitima = document.getElementById('vitima')
const ocultar = document.getElementById('hide')

vitma.addEventListener('change', () => {
    if (this.value == 'sim') {
        ocultar.classList.remove('hidden')
    }
    else {
        ocultar.classList.add('hidden')
    }
})
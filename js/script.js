document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.seta').forEach((botao) => {
        botao.addEventListener('click', () => {
            const categoria = botao.closest('.categoria');
            const livros = categoria.querySelector('.livros');

            if (!livros) return;

            const deslocamento = livros.clientWidth * 0.8;
            const direcao = botao.classList.contains('seta-esquerda') ? -1 : 1;

            livros.scrollBy({
                left: deslocamento * direcao,
                behavior: 'smooth'
            });
        });
    });
});
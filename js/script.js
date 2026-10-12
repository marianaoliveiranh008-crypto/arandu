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

// -------------------------------------------------//

document.addEventListener('DOMContentLoaded', () => {
    const inputPesquisa = document.getElementById('inputPesquisa');
    const livros = document.querySelectorAll('.livro');
    const categorias = document.querySelectorAll('.categoria');

    if (!inputPesquisa) return;

    inputPesquisa.addEventListener('input', (event) => {
        const termo = event.target.value.toLowerCase().trim();

        livros.forEach((livro) => {
            const titulo = livro.querySelector('h3').textContent.toLowerCase();

            if (titulo.includes(termo)) {
                livro.style.display = '';
            } else {
                livro.style.display = 'none';
            }
        });

        categorias.forEach((categoria) => {
            const livrosVisiveis = categoria.querySelectorAll('.livro:not([style*="display: none"])');

            if (livrosVisiveis.length === 0) {
                categoria.style.display = 'none';
            } else {
                categoria.style.display = '';
            }
        });
    });
});
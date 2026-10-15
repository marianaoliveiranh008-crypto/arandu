<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho - Arandu</title>
    <link rel="stylesheet" href="css/style.css?v=4">
</head>
<body class="carrinho-page">

    <header class="cabecalho">
        <div class="logo">
            <a href="index.php" aria-label="Arandu - página inicial">
                <img src="img/logo.png" alt="Arandu">
            </a>
        </div>

        <nav class="carrinho-nav" aria-label="Menu principal">
            <a href="index.php">Home</a>
            <a href="sobreNos.php">Sobre nós</a>
            <a href="#">+ Procurados</a>
            <a href="#">Novidades</a>
        </nav>

        <div class="icones" aria-label="Atalhos da conta">
            <a href="carrinho.php" title="Carrinho" aria-label="Carrinho">🛍</a>
            <a href="login.php" title="Entrar" aria-label="Entrar">♙</a>
        </div>
    </header>

    <main class="conteudo">
        <section class="carrinho">
            <h1>Meu carrinho</h1>

            <div class="livro">
                <img src="https://m.media-amazon.com/images/I/71bWGcFrLCL._SL1500_.jpg" alt="Capa do livro A Teus Pés">

                <div class="informacoes">
                    <h2>A Teus Pés</h2>
                    <p class="autor">Por: Ana Cristina Cesar</p>

                    <div class="quantidade">
                        <button type="button" aria-label="Diminuir quantidade de A Teus Pés">-</button>
                        <span>1</span>
                        <button type="button" aria-label="Aumentar quantidade de A Teus Pés">+</button>
                    </div>

                    <div class="preco">
                        <span>R$50,00</span>
                        <button class="excluir" type="button" aria-label="Remover A Teus Pés do carrinho">Excluir</button>
                    </div>
                </div>
            </div>

            <div class="livro">
                <img src="https://m.media-amazon.com/images/I/816Udvs9O7L._SL1500_.jpg" alt="Capa do livro Tudo é Rio">

                <div class="informacoes">
                    <h2>Tudo é Rio</h2>
                    <p class="autor">Por: Carla Madeira</p>

                    <div class="quantidade">
                        <button type="button" aria-label="Diminuir quantidade de Tudo é Rio">-</button>
                        <span>2</span>
                        <button type="button" aria-label="Aumentar quantidade de Tudo é Rio">+</button>
                    </div>

                    <div class="preco">
                        <span>R$39,99</span>
                        <button class="excluir" type="button" aria-label="Remover Tudo é Rio do carrinho">Excluir</button>
                    </div>
                </div>
            </div>

            <div class="resumo">
                <p><span>Subtotal</span><strong>R$129,98</strong></p>
                <p><span>Frete</span><strong>A calcular</strong></p>
                <p class="resumo-total"><span>Total</span><strong>A calcular</strong></p>
            </div>

            <div class="botoes">
                <button type="button">Calcular frete</button>
                <a href="finalizarCompra.php">Finalizar compra</a>
            </div>
        </section>
    </main>

</body>
</html>
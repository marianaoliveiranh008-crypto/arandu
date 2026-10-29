<?php
    session_start();
    $totalItensCarrinho = 0;
    if(isset($_SESSION['carrinho'])) {
        foreach ($_SESSION['carrinho'] as $item) {
            $totalItensCarrinho += $item['quantidade'];
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mais procurados</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body>
    <header class="top-header">
        <div class="brand">
            <img src="img/logo.png" alt="Arandu">
        </div>

        <nav class="nav-menu" aria-label="Menu principal">
            <a href="index.php">Home</a>
            <a href="sobreNos.php">Sobre nós</a>
            <a href="maisProcurados.php">+ Procurados</a>
            <a href="novidades.php">Novidades</a>
        </nav>

        <div class="header-actions">
            <div class="user-tools">
                <a href="carrinho.php" class="header-button cart-link" aria-label="Carrinho de compras">
                    <span aria-hidden="true">🛍</span>
                    <span></span>
                    <span class="cart-count">0</span>
                </a>
                <a href="login.php" class="header-button login-link">Entrar</a>
                <a href="usuario/perfil.php" class="header-button admin-link">
                    <span aria-hidden="true">👤</span>
                    <span></span>
                </a>
            </div>
        </div>
    </header>

    <main class="page-home">
        <section class="categoria">
            <div class="titulo">
                <h2>Populares na Arandu</h2>
                <span>›</span>
            </div>

            <button class="seta seta-esquerda" type="button" aria-label="Anterior">‹</button>


            <div class="livros">
                <article class="livro">
                    <a href="compras/detalhes.php?id=4"><img src="https://m.media-amazon.com/images/I/51RjYjNVpRL._SL1000_.jpg"  alt="Olhos D'Água"></a>
                    <h3>Olhos D'Água</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Olhos D'Água">
                        <input type="hidden" name="nome" value="Olhos D'Água">
                        <input type="hidden" name="preco" value="35,00">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/51RjYjNVpRL._SL1000_.jpg">
                        <input type="hidden" name="autor" value="Conceição Evaristo">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 35,00</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php?id=14"><img src="https://m.media-amazon.com/images/I/71bWGcFrLCL._SL1500_.jpg"  alt="A Teus Pés"></a>
                    <h3>A Teus Pés</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="A Teus Pés">
                        <input type="hidden" name="nome" value="A Teus Pés">
                        <input type="hidden" name="preco" value="29,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/71bWGcFrLCL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Ana Cristina Cesar">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 29,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php?id=39"><img src="https://m.media-amazon.com/images/I/71AYPfbv2BL._SL1500_.jpg"  alt="Morte e vida severina"></a>
                    <h3>Morte e vida severina</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Morte e vida severina">
                        <input type="hidden" name="nome" value="Morte e vida severina">
                        <input type="hidden" name="preco" value="49,00">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/71AYPfbv2BL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="João Cabral de Melo Neto">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 49,00</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php?id=40"><img src="https://m.media-amazon.com/images/I/81Pp8Zed8IL._SL1500_.jpg"  alt="Eles não usam black-tie"></a>
                    <h3>Eles não usam black-tie</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Eles não usam black-tie">
                        <input type="hidden" name="nome" value="Eles não usam black-tie">
                        <input type="hidden" name="preco" value="41,99">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/81Pp8Zed8IL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Gianfrancesco Guarnieri">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 41,99</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php?id=31"><img src="https://m.media-amazon.com/images/I/71AeB1+8dZL._SL1500_.jpg"  alt="Jantar secreto"></a>
                    <h3>Jantar secreto</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Jantar secreto">
                        <input type="hidden" name="nome" value="Jantar secreto">
                        <input type="hidden" name="preco" value="47,99">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/71AeB1+8dZL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Raphael Montes">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 47,99</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php?id=48"><img src="https://m.media-amazon.com/images/I/71H2cISR4JL._SL1500_.jpg"  alt="Suzane: Assassina e Manipuladora"></a>
                    <h3>Suzane: Assassina e Manipuladora</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Suzane: Assassina e Manipuladora">
                        <input type="hidden" name="nome" value="Suzane: Assassina e Manipuladora">
                        <input type="hidden" name="preco" value="58,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/71H2cISR4JL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Ullisses Campbell">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 58,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php?id=27"><img src="https://m.media-amazon.com/images/I/81XqiNjr5OL._SL1500_.jpg"  alt="Suicidas"></a>
                    <h3>Suicidas</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Suicidas">
                        <input type="hidden" name="nome" value="Suicidas">
                        <input type="hidden" name="preco" value="48,00">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/81XqiNjr5OL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Raphael Montes">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 48,00</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php?id=21"><img src="https://m.media-amazon.com/images/I/71nCJmJiXgL._SL1500_.jpg"  alt="As Mentiras que os Homens Contam"></a>
                    <h3>As Mentiras que os Homens Contam</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="As Mentiras que os Homens Contam">
                        <input type="hidden" name="nome" value="As Mentiras que os Homens Contam">
                        <input type="hidden" name="preco" value="79,99">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/71nCJmJiXgL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Luis Fernando Verissimo">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 79,99</button>
                    </form>
                </article>
            </div>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>

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
    <title>Novidades</title>
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
                <h2>Novidades na Arandu</h2>
                <span>›</span>
            </div>

            <button class="seta seta-esquerda" type="button" aria-label="Anterior">‹</button>


            <div class="livros">
                <article class="livro">
                    <a href="compras/detalhes.php?id=26"><img src="https://m.media-amazon.com/images/I/71YSm7ehYqL._SL1500_.jpg"  alt="A estranha na cama"></a>
                    <h3>A estranha na cama</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="A estranha na cama">
                        <input type="hidden" name="nome" value="A estranha na cama">
                        <input type="hidden" name="preco" value="55,15">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/71YSm7ehYqL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Raphael Montes">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 55,15</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php?id=24"><img src="https://m.media-amazon.com/images/I/81PX7q67zDL._SL1500_.jpg" alt="Hoje Eu Quero Voltar Sozinho"></a>
                    <h3>Hoje Eu Quero Voltar Sozinho</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="HojeEuQueroVoltarSozinho">
                        <input type="hidden" name="nome" value="Hoje Eu Quero Voltar Sozinho">
                        <input type="hidden" name="preco" value="48,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/81PX7q67zDL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Daniel Ribeiro">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 48,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php?id=45"><img src="https://m.media-amazon.com/images/I/71nZEvqqJjL._SL1500_.jpg"  alt="Quando"></a>
                    <h3>Quando</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Quando">
                        <input type="hidden" name="nome" value="Quando">
                        <input type="hidden" name="preco" value="60,00">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/71nZEvqqJjL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Carla Madeira">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 60,00</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php?id=29"><img src="https://m.media-amazon.com/images/I/81f0UbBO-KL._SL1500_.jpg"  alt="Dias perfeitos (edição colecionador)"></a>
                    <h3>Dias perfeitos (edição colecionador)</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Dias perfeitos (edição colecionador)">
                        <input type="hidden" name="nome" value="Dias perfeitos (edição colecionador)">
                        <input type="hidden" name="preco" value="69,00">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/81f0UbBO-KL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Raphael Montes">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 69,00</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php?id=28"><img src="https://m.media-amazon.com/images/I/81WjGu5a5ZL._SL1500_.jpg"  alt="Uma família feliz"></a>
                    <h3>Uma família feliz</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Uma família feliz">
                        <input type="hidden" name="nome" value="Uma família feliz">
                        <input type="hidden" name="preco" value="47,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/81WjGu5a5ZL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Raphael Montes">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 47,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php?id=25"><img src="https://m.media-amazon.com/images/I/714yEGAjivL._SL1500_.jpg"  alt="Quinze Dias"></a>
                    <h3>Quinze Dias</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="QuinzeDias">
                        <input type="hidden" name="nome" value="Quinze Dias">
                        <input type="hidden" name="preco" value="43,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/714yEGAjivL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Vitor Martins">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 43,90</button>
                    </form>
                </article>
            </div>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>

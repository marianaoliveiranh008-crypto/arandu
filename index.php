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
    <title>Arandu - Livraria</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body>
    <header class="top-header">
        <div class="brand">
            <img src="img/logo.png" alt="Arandu">
        </div>

        <nav class="nav-menu" aria-label="Menu principal">
            <a href="#">Home</a>
            <a href="sobreNos.php">Sobre nós</a>
            <a href="#">+ Procurados</a>
            <a href="#">Novidades</a>
        </nav>

        <div class="header-actions">
            <label class="search-box" aria-label="Pesquisar livro">
                <span aria-hidden="true">⌕</span>
                <input type="search" id="inputPesquisa" placeholder="Pesquisar..." aria-label="Pesquisar livro">
            </label>

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
                <h2>Romance</h2>
                <span>›</span>
            </div>

            <button class="seta seta-esquerda" type="button" aria-label="Anterior">‹</button>

            <div class="livros">
                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81t7altQZxL._SL1500_.jpg" alt="Capitães de Areia"></a>
                    <h3>Capitães de Areia</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="CapitaesDeAreia">
                        <input type="hidden" name="nome" value="Capitães de Areia">
                        <input type="hidden" name="preco" value="24.99">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/81t7altQZxL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Jorge Amado">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 24,99</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71OL9RU2tJL._SL1360_.jpg" alt="Memórias Póstumas de Brás Cubas"></a>
                    <h3>Memórias Póstumas de Brás Cubas</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="MemoriasPostumasDeBrasCubas">
                        <input type="hidden" name="nome" value="Memórias Póstumas de Brás Cubas">
                        <input type="hidden" name="preco" value="69,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/71OL9RU2tJL._SL1360_.jpg">
                        <input type="hidden" name="autor" value="Machado de Assis">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 69,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71p3cRkpytL._SL1500_.jpg" alt="Iracema: Cinco Minutos"></a>
                    <h3>Iracema: Cinco Minutos</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Iracema: Cinco Minutos">
                        <input type="hidden" name="nome" value="Iracema: Cinco Minutos">
                        <input type="hidden" name="preco" value="59,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/71p3cRkpytL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="José de Alencar">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 59,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/61TaHURu27L._SL1000_.jpg" alt="A Hora da Estrela"></a>
                    <h3>A Hora da Estrela</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="AHoraDaEstrela">
                        <input type="hidden" name="nome" value="A Hora da Estrela">
                        <input type="hidden" name="preco" value="44,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/61TaHURu27L._SL1000_.jpg">
                        <input type="hidden" name="autor" value="Clarice Lispector">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 44,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71FT8rYeZaL._SL1000_.jpg " alt="Agua viva"></a>
                    <h3>Água viva</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="AguaViva">
                        <input type="hidden" name="nome" value="Água viva">
                        <input type="hidden" name="preco" value="49,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/71FT8rYeZaL._SL1000_.jpg">
                        <input type="hidden" name="autor" value="Clarice Lispector">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 49,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/61j0riyfENL._SL1500_.jpg " alt="Oração para Desaparecer"></a>
                    <h3>Oração para Desaparecer</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="OraçãoParaDesaparecer">
                        <input type="hidden" name="nome" value="Oração para Desaparecer">
                        <input type="hidden" name="preco" value="74,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/61j0riyfENL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Socorro Acioli">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 74,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/816Udvs9O7L._SL1500_.jpg " alt="Tudo é Rio"></a>
                    <h3>Tudo é Rio</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="TudoErio">
                        <input type="hidden" name="nome" value="Tudo é Rio">
                        <input type="hidden" name="preco" value="69,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/816Udvs9O7L._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Carla Madeira">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 69,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71gXpS2PAgL._SL1500_.jpg " alt="Torto Arado"></a>
                    <h3>Torto Arado</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="TortoArado">
                        <input type="hidden" name="nome" value="Torto Arado">
                        <input type="hidden" name="preco" value="89,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/71gXpS2PAgL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Itamar Vieira Junior">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 89,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71-YhujYUxS._SL1500_.jpg" alt="A Cabeça do Santo"></a>
                    <h3>A Cabeça do Santo</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="ACabecaDoSanto">
                        <input type="hidden" name="nome" value="A Cabeça do Santo">
                        <input type="hidden" name="preco" value="74,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/71-YhujYUxS._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Socorro Acioli">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 74,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81p29WCHFaL._SL1500_.jpg" alt="O Avesso da Pele"></a>
                    <h3>O Avesso da Pele</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="OAvessoDaPele">
                        <input type="hidden" name="nome" value="O Avesso da Pele">
                        <input type="hidden" name="preco" value="79,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/81p29WCHFaL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Jeferson Tenório">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 79,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/710CrKZ5U9L._SL1500_.jpg " alt="Ainda Estou Aqui"></a>
                    <h3>Ainda Estou Aqui</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="AindaEstouAqui">
                        <input type="hidden" name="nome" value="Ainda Estou Aqui">
                        <input type="hidden" name="preco" value="29,99">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/710CrKZ5U9L._SL1500_.jpg ">
                        <input type="hidden" name="autor" value="Marcelo Rubens Paiva">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 29,99</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81QMKBbgGWL._SL1500_.jpg" alt="O Meu Pé de Laranja Lima"></a>
                    <h3>O Meu Pé de Laranja Lima</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="OMeuPedeLaranjaLima">
                        <input type="hidden" name="nome" value="O Meu Pé de Laranja Lima">
                        <input type="hidden" name="preco" value="35,00">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/81QMKBbgGWL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="José Mauro de Vasconcelos">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 35,00</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81PX7q67zDL._SL1500_.jpg" alt="Hoje Eu Quero Voltar Sozinho"></a>
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
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/714yEGAjivL._SL1500_.jpg"  alt="Quinze Dias"></a>
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

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/91ADwCpigxL._SL1500_.jpg"  alt="Véspera"></a>
                    <h3>Véspera</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Véspera">
                        <input type="hidden" name="nome" value="Véspera">
                        <input type="hidden" name="preco" value="50,00">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/91ADwCpigxL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Carla Madeira">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 50,00</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71zDFgnh8-L._SL1500_.jpg"  alt="A natureza da mordida"></a>
                    <h3>A natureza da mordida</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="A natureza da mordida">
                        <input type="hidden" name="nome" value="A natureza da mordida">
                        <input type="hidden" name="preco" value="40,50">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/71zDFgnh8-L._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Carla Madeira">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 40,50</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/61x1ZHomWUL._SY466_.jpg"  alt="Dom Casmurro"></a>
                    <h3>Dom Casmurro</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Dom Casmurro">
                        <input type="hidden" name="nome" value="Dom Casmurro">
                        <input type="hidden" name="preco" value="20,00">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/61x1ZHomWUL._SY466_.jpg">
                        <input type="hidden" name="autor" value="Machado de Assis">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 20,00</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/617dduF7b+L._SL1021_.jpg"  alt="Quincas Borba"></a>
                    <h3>Quincas Borba</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Quincas Borba">
                        <input type="hidden" name="nome" value="Quincas Borba">
                        <input type="hidden" name="preco" value="15,00">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/617dduF7b+L._SL1021_.jpg">
                        <input type="hidden" name="autor" value="Machado de Assis">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 15,00</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/913ySpzYczL._SL1500_.jpg"  alt="Pequena coreografia do adeus"></a>
                    <h3>Pequena coreografia do adeus</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Pequena coreografia do adeus">
                        <input type="hidden" name="nome" value="Pequena coreografia do adeus">
                        <input type="hidden" name="preco" value="45,00">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/913ySpzYczL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Aline Bei">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 45,00</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81e94f06FcL._SL1500_.jpg"  alt="Perto do coração selvagem: Edição comemorativa"></a>
                    <h3>Perto do coração selvagem: Edição comemorativa</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="PertoDoCoraçãoSelvagemEdiçãoComemorativa">
                        <input type="hidden" name="nome" value="Perto do coração selvagem: Edição comemorativa">
                        <input type="hidden" name="preco" value="39,85">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/81e94f06FcL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Clarice Lispector">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 39,85</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71nZEvqqJjL._SL1500_.jpg"  alt="Quando"></a>
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
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71xF7YF2BsL._SY466_.jpg"  alt="Bom Crioulo"></a>
                    <h3>Bom Crioulo</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Bom Crioulo">
                        <input type="hidden" name="nome" value="Bom Crioulo">
                        <input type="hidden" name="preco" value="65,00">
                        <input type="hidden" name="imagem" value=" https://m.media-amazon.com/images/I/71xF7YF2BsL._SY466_.jpg">
                        <input type="hidden" name="autor" value="Adolfo Caminha">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 65,00</button>
                    </form>
                </article>
            </div>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>

        <section class="categoria">
            <div class="titulo">
                <h2>Thriller, Suspense e Terror</h2>
                <span>›</span>
            </div>

            <button class="seta seta-esquerda" type="button" aria-label="Anterior">‹</button>

            <div class="livros">
                 <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/919+LCGBrML._SL1500_.jpg"  alt="A mágica mortal: Uma aventura do Esquadrão Zero"></a>
                    <h3>A mágica mortal: Uma aventura do Esquadrão Zero</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="A mágica mortal: Uma aventura do Esquadrão Zero">
                        <input type="hidden" name="nome" value="A mágica mortal: Uma aventura do Esquadrão Zero">
                        <input type="hidden" name="preco" value="55,14">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/919+LCGBrML._SL1500_.jpg ">
                        <input type="hidden" name="autor" value="Raphael Montes">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 55,14</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71YSm7ehYqL._SL1500_.jpg"  alt="A estranha na cama"></a>
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
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81XqiNjr5OL._SL1500_.jpg"  alt="Suicidas"></a>
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
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81WjGu5a5ZL._SL1500_.jpg"  alt="Uma família feliz"></a>
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
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81f0UbBO-KL._SL1500_.jpg"  alt="Dias perfeitos (edição colecionador)"></a>
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
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71AeB1+8dZL._SL1500_.jpg"  alt="Jantar secreto"></a>
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
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71nbAlbz1tL._SY466_.jpg"  alt="Uma mulher no escuro"></a>
                    <h3>Uma mulher no escuro</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Uma mulher no escuro">
                        <input type="hidden" name="nome" value="Uma mulher no escuro">
                        <input type="hidden" name="preco" value="46,00">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/71nbAlbz1tL._SY466_.jpg">
                        <input type="hidden" name="autor" value="Raphael Montes">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 46,00</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/61k-lrleRAL._SL1500_.jpg"  alt="Bom Dia, Verônica"></a>
                    <h3>Bom Dia, Verônica</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Bom Dia, Verônica">
                        <input type="hidden" name="nome" value="Bom Dia, Verônica">
                        <input type="hidden" name="preco" value="52,50">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/61k-lrleRAL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Raphael Montes e Ilana Casoy">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 52,50</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81JaIN9NExL._SL1500_.jpg"  alt="O vilarejo"></a>
                    <h3>O vilarejo</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="O vilarejo">
                        <input type="hidden" name="nome" value="O vilarejo">
                        <input type="hidden" name="preco" value="39,80">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/81JaIN9NExL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Raphael Montes">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 39,80</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81miClxArsL._SL1500_.jpg"  alt="7 histórias de gelar o sangue"></a>
                    <h3>7 histórias de gelar o sangue</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="7 histórias de gelar o sangue">
                        <input type="hidden" name="nome" value="7 histórias de gelar o sangue">
                        <input type="hidden" name="preco" value="20,00">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/81miClxArsL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Antonio Schimeneck">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 20,00</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/61-1f03P5kL._SL1000_.jpg"  alt="Mais 7 histórias de gelar o sangue"></a>
                    <h3>Mais 7 histórias de gelar o sangue</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Mais 7 histórias de gelar o sangue">
                        <input type="hidden" name="nome" value="Mais 7 histórias de gelar o sangue">
                        <input type="hidden" name="preco" value="41,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/61-1f03P5kL._SL1000_.jpg">
                        <input type="hidden" name="autor" value="Antonio Schimeneck">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 41,90</button>
                    </form>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81C7tRvveSL._SL1500_.jpg"  alt="A verdade em preto e branco"></a>
                    <h3>A verdade em preto e branco</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="A verdade em preto e branco">
                        <input type="hidden" name="nome" value="A verdade em preto e branco">
                        <input type="hidden" name="preco" value="40,00">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/81C7tRvveSL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Antonio Schimeneck">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 40,00</button>
                    </form>
                </article>
                </article>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>

        <section class="categoria">
            <div class="titulo">
                <h2>Contos e crônicas</h2>
                <span>›</span>
            </div>

            <button class="seta seta-esquerda" type="button" aria-label="Anterior">‹</button>

            <div class="livros">
                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/51RjYjNVpRL._SL1000_.jpg"  alt="Olhos D'Água"></a>
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
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/A1fbkGex+bL._SL1500_.jpg"  alt="Chapeuzinho Amarelo"></a>
                    <h3>Chapeuzinho Amarelo</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Chapeuzinho Amarelo">
                        <input type="hidden" name="nome" value="Chapeuzinho Amarelo">
                        <input type="hidden" name="preco" value="41,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/A1fbkGex+bL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Chico Buarque">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 41,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81miClxArsL._SL1500_.jpg"  alt="7 histórias de gelar o sangue"></a>
                    <h3>7 histórias de gelar o sangue</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="7 histórias de gelar o sangue">
                        <input type="hidden" name="nome" value="7 histórias de gelar o sangue">
                        <input type="hidden" name="preco" value="20,00">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/81miClxArsL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Antonio Schimeneck">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 20,00</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/61-1f03P5kL._SL1000_.jpg"  alt="Mais 7 histórias de gelar o sangue"></a>
                    <h3>Mais 7 histórias de gelar o sangue</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Mais 7 histórias de gelar o sangue">
                        <input type="hidden" name="nome" value="Mais 7 histórias de gelar o sangue">
                        <input type="hidden" name="preco" value="41,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/61-1f03P5kL._SL1000_.jpg">
                        <input type="hidden" name="autor" value="Antonio Schimeneck">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 41,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71kzs3gIwpL._SY466_.jpg"  alt="Morangos mofados"></a>
                    <h3>Morangos mofados</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Morangos mofados">
                        <input type="hidden" name="nome" value="Morangos mofados">
                        <input type="hidden" name="preco" value="59,00">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/71kzs3gIwpL._SY466_.jpg">
                        <input type="hidden" name="autor" value="Caio Fernando Abreu">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 59,00</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71FT8rYeZaL._SL1000_.jpg " alt="Agua viva"></a>
                    <h3>Água viva</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="AguaViva">
                        <input type="hidden" name="nome" value="Água viva">
                        <input type="hidden" name="preco" value="49,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/71FT8rYeZaL._SL1000_.jpg">
                        <input type="hidden" name="autor" value="Clarice Lispector">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 49,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/913ySpzYczL._SL1500_.jpg"  alt="Pequena coreografia do adeus"></a>
                    <h3>Pequena coreografia do adeus</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Pequena coreografia do adeus">
                        <input type="hidden" name="nome" value="Pequena coreografia do adeus">
                        <input type="hidden" name="preco" value="45,00">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/913ySpzYczL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Aline Bei">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 45,00</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71nCJmJiXgL._SL1500_.jpg"  alt="As Mentiras que os Homens Contam"></a>
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

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81L2LaymKIL._SL1500_.jpg"  alt="As Mentiras que as Mulheres Contam"></a>
                    <h3>As Mentiras que as Mulheres Contam</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="As Mentiras que as Mulheres Contam">
                        <input type="hidden" name="nome" value="As Mentiras que as Mulheres Contam">
                        <input type="hidden" name="preco" value="79,99">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/81L2LaymKIL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Luis Fernando Verissimo">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 79,99</button>
                    </form>
                </article>
            </div>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>

        <section class="categoria">
            <div class="titulo">
                <h2>Literatura infantil</h2>
                <span>›</span>
            </div>

            <button class="seta seta-esquerda" type="button" aria-label="Anterior">‹</button>

            <div class="livros">
                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/910wNGmLT4L._SL1500_.jpg"  alt="Amoras"></a>
                    <h3>Amoras</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Amoras">
                        <input type="hidden" name="nome" value="Amoras">
                        <input type="hidden" name="preco" value="54,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/910wNGmLT4L._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Emicida">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 54,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71Z98sh5RuL._SL1300_.jpg"  alt="Menina Bonita do Laço de Fita"></a>
                    <h3>Menina Bonita do Laço de Fita</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Menina Bonita do Laço de Fita">
                        <input type="hidden" name="nome" value="Menina Bonita do Laço de Fita">
                        <input type="hidden" name="preco" value="34,99">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/71Z98sh5RuL._SL1300_.jpg">
                        <input type="hidden" name="autor" value="Ana Maria Machado">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 34,99</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/A1fbkGex+bL._SL1500_.jpg"  alt="Chapeuzinho Amarelo"></a>
                    <h3>Chapeuzinho Amarelo</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Chapeuzinho Amarelo">
                        <input type="hidden" name="nome" value="Chapeuzinho Amarelo">
                        <input type="hidden" name="preco" value="41,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/A1fbkGex+bL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Chico Buarque">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 41,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/91u1X7IttSL._SL1500_.jpg"  alt="Ou Isto Ou Aquilo"></a>
                    <h3>Ou Isto Ou Aquilo</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Ou Isto Ou Aquilo">
                        <input type="hidden" name="nome" value="Ou Isto Ou Aquilo">
                        <input type="hidden" name="preco" value="38,70">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/91u1X7IttSL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Emicida">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 38,70</button>
                    </form>
                </article>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>

        <section class="categoria">
            <div class="titulo">
                <h2>Não Ficção</h2>
                <span>›</span>
            </div>

            <button class="seta seta-esquerda" type="button" aria-label="Anterior">‹</button>

            <div class="livros">
                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71OH6jq5QJL._SL1358_.jpg"  alt="Casa de Alvenaria - Volume 1: Osasco"></a>
                    <h3>Casa de Alvenaria - Volume 1: Osasco</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Casa de Alvenaria - Volume 1: Osasco">
                        <input type="hidden" name="nome" value="Casa de Alvenaria - Volume 1: Osasco">
                        <input type="hidden" name="preco" value="69,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/71OH6jq5QJL._SL1358_.jpg">
                        <input type="hidden" name="autor" value="Carolina Maria de Jesus">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 69,90</button>
                    </form>
                </article>   

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/61bRqcILmBL._SL1010_.jpg"  alt="Holocausto Brasileiro: Genocídio: 60 mil mortos no maior hospício do Brasil"></a>
                    <h3>Holocausto Brasileiro: Genocídio: 60 mil mortos no maior hospício do Brasil</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Holocausto Brasileiro: Genocídio: 60 mil mortos no maior hospício do Brasil">
                        <input type="hidden" name="nome" value="Holocausto Brasileiro: Genocídio: 60 mil mortos no maior hospício do Brasil">
                        <input type="hidden" name="preco" value="46,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/61bRqcILmBL._SL1010_.jpg">
                        <input type="hidden" name="autor" value="Daniela Arbex">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 46,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71H2cISR4JL._SL1500_.jpg"  alt="Suzane: Assassina e Manipuladora"></a>
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
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71Uw783uI5L._SL1500_.jpg"  alt="Elize Matsunaga: A Mulher que Matou o Marido"></a>
                    <h3>Elize Matsunaga: A Mulher que Matou o Marido</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Elize Matsunaga: A Mulher que Matou o Marido">
                        <input type="hidden" name="nome" value="Elize Matsunaga: A Mulher que Matou o Marido">
                        <input type="hidden" name="preco" value="58,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/71Uw783uI5L._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Ullisses Campbell">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 58,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/91sOa8t-JuL._SL1500_.jpg"  alt="Flordelis: A Pastora do Diabo"></a>
                    <h3>Flordelis: A Pastora do Diabo</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Flordelis: A Pastora do Diabo">
                        <input type="hidden" name="nome" value="Flordelis: A Pastora do Diabo">
                        <input type="hidden" name="preco" value="58,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/91sOa8t-JuL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Ullisses Campbell">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 58,90</button>
                    </form>
                </article>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>

        <section class="categoria">
            <div class="titulo">
                <h2>Drama</h2>
                <span>›</span>
            </div>

            <button class="seta seta-esquerda" type="button" aria-label="Anterior">‹</button>

            <div class="livros">
                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81WjGu5a5ZL._SL1500_.jpg"  alt="Uma família feliz"></a>
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
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/61k-lrleRAL._SL1500_.jpg"  alt="Bom Dia, Verônica"></a>
                    <h3>Bom Dia, Verônica</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Bom Dia, Verônica">
                        <input type="hidden" name="nome" value="Bom Dia, Verônica">
                        <input type="hidden" name="preco" value="52,50">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/61k-lrleRAL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Raphael Montes e Ilana Casoy">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 52,50</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71AYPfbv2BL._SL1500_.jpg"  alt="Morte e vida severina"></a>
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
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81Pp8Zed8IL._SL1500_.jpg"  alt="Eles não usam black-tie"></a>
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
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>

        <section class="categoria">
            <div class="titulo">
                <h2>Poesia</h2>
                <span>›</span>
            </div>

            <button class="seta seta-esquerda" type="button" aria-label="Anterior">‹</button>

            <div class="livros">
                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71bWGcFrLCL._SL1500_.jpg"  alt="A Teus Pés"></a>
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
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/910wNGmLT4L._SL1500_.jpg"  alt="Amoras"></a>
                    <h3>Amoras</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Amoras">
                        <input type="hidden" name="nome" value="Amoras">
                        <input type="hidden" name="preco" value="54,90">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/910wNGmLT4L._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Emicida">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 54,90</button>
                    </form>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/91u1X7IttSL._SL1500_.jpg"  alt="Ou Isto Ou Aquilo"></a>
                    <h3>Ou Isto Ou Aquilo</h3>
                    <form action="carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="Ou Isto Ou Aquilo">
                        <input type="hidden" name="nome" value="Ou Isto Ou Aquilo">
                        <input type="hidden" name="preco" value="38,70">
                        <input type="hidden" name="imagem" value="https://m.media-amazon.com/images/I/91u1X7IttSL._SL1500_.jpg">
                        <input type="hidden" name="autor" value="Emicida">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ 38,70</button>
                    </form>
                </article>
            </div>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>

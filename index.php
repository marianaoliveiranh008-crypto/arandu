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
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81t7altQZxL._SL1500_.jpg"alt="Capitães de Areia"></a>
                    <h3>Capitães de Areia</h3>
                    <a href="compras/detalhes.php">R$24,99</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src=" https://m.media-amazon.com/images/I/71OL9RU2tJL._SL1360_.jpg " alt="Memórias Póstumas de Brás Cubas"></a>
                    <h3>Memórias Póstumas de Brás Cubas</h3>
                    <a href="compras/detalhes.php">R$69,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src=" https://m.media-amazon.com/images/I/71p3cRkpytL._SL1500_.jpg " alt="Iracema"></a>
                    <h3>Iracema</h3>
                    <a href="compras/detalhes.php">R$59,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/61TaHURu27L._SL1000_.jpg " alt="A Hora da Estrela"></a>
                    <h3>A Hora da Estrela</h3>
                    <a href="compras/detalhes.php">R$44,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/61j0riyfENL._SL1500_.jpg " alt="Oração para Desaparecer"></a>
                    <h3>Oração para Desaparecer</h3>
                    <a href="compras/detalhes.php">R$74,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71FT8rYeZaL._SL1000_.jpg " alt="Agua viva"></a>
                    <h3>Agua viva</h3>
                    <a href="compras/detalhes.php">R$49,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/816Udvs9O7L._SL1500_.jpg " alt="Tudo é Rio"></a>
                    <h3>Tudo é Rio</h3>
                    <a href="compras/detalhes.php">R$59,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71gXpS2PAgL._SL1500_.jpg " alt="Torto Arado"></a>
                    <h3> Torto Arado</h3>
                    <a href="compras/detalhes.php">R$69,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71-YhujYUxS._SL1500_.jpg" alt="A Cabeça do Santo"></a>
                    <h3>A Cabeça do Santo</h3>
                    <a href="compras/detalhes.php">R$79,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81p29WCHFaL._SL1500_.jpg" alt="O Avesso da Pele"></a>
                    <h3>O Avesso da Pele</h3>
                    <a href="compras/detalhes.php">R$89,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/710CrKZ5U9L._SL1500_.jpg " alt="Ainda Estou Aqui"></a>
                    <h3>Ainda Estou Aqui</h3>
                    <a href="compras/detalhes.php">R$99,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81QMKBbgGWL._SL1500_.jpg " alt="Melhoramentos"></a>
                    <h3>Melhoramentos</h3>
                    <a href="compras/detalhes.php">R$109,90</a>
                </article>
            </div>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>

        <section class="categoria">
            <div class="titulo">
                <h2>Romance psicológico</h2>
                <span>›</span>
            </div>

            <button class="seta seta-esquerda" type="button" aria-label="Anterior">‹</button>

            <div class="livros">
                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71OL9RU2tJL._SL1360_.jpg" alt="Memórias Póstumas de Brás Cubas"></a>
                    <h3>Memórias Póstumas de Brás Cubas</h3>
                    <a href="compras/detalhes.php">R$49,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/816Udvs9O7L._SL1500_.jpg" alt="Tudo é Rio"></a>
                    <h3>Tudo é Rio</h3>
                    <a href="compras/detalhes.php">R$59,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/710CrKZ5U9L._SL1500_.jpg " alt="Ainda Estou Aqui"></a>
                    <h3>Ainda Estou Aqui</h3>
                    <a href="compras/detalhes.php">R$69,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/61LMXwQZmEL._SL1500_.jpg " alt="Ideias para adiar o fim do mundo"></a>
                    <h3>Ideias para adiar o fim do mundo</h3>
                    <a href="compras/detalhes.php">R$79,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/61bRqcILmBL._SL1010_.jpg" alt=" Holocausto Brasileiro: Genocídio: 60 mil mortos no maior hospício do Brasil"></a>
                    <h3>Holocausto Brasileiro: Genocídio: 60 mil mortos no maior hospício do Brasil</h3>
                    <a href="compras/detalhes.php">R$44,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81WjGu5a5ZL._SL1500_.jpg" alt="Uma família feliz"></a>
                    <h3>Uma família feliz</h3>
                    <a href="compras/detalhes.php">R$59,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81f0UbBO-KL._SL1500_.jpg" alt="Dias perfeitos (edição colecionador)"></a>
                    <h3>Dias perfeitos (edição colecionador)</h3>
                    <a href="compras/detalhes.php">R$89,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71AeB1+8dZL._SL1500_.jpg" alt="Jantar secreto"></a>
                    <h3>Jantar secreto</h3>
                    <a href="compras/detalhes.php">R$99,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71nbAlbz1tL._SY466_.jpg" alt="Uma mulher no escuro"></a>
                    <h3>Uma mulher no escuro</h3>
                    <a href="compras/detalhes.php">R$109,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/91ADwCpigxL._SL1500_.jpg" alt="Véspera"></a>
                    <h3>Véspera</h3>
                    <a href="compras/detalhes.php">R$119,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71zDFgnh8-L._SL1500_.jpg" alt=" A natureza da mordida"></a>
                    <h3> A natureza da mordida</h3>
                    <a href="compras/detalhes.php">R$19,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/61x1ZHomWUL._SY466_.jpg " alt="Machado de Assis "></a>
                    <h3>Machado de Assis</h3>
                    <a href="compras/detalhes.php">R$33,90</a>
                </article>
            </div>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>

        <section class="categoria">
            <div class="titulo">
                <h2>Romance regionalista</h2>
                <span>›</span>
            </div>

            <button class="seta seta-esquerda" type="button" aria-label="Anterior">‹</button>

            <div class="livros">
                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/913ySpzYczL._SL1500_.jpg " alt="Pequena coreografia do adeus"></a>
                    <h3>Pequena coreografia do adeus</h3>
                    <a href="compras/detalhes.php">R$49,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71nZEvqqJjL._SL1500_.jpg" alt="Quando"></a>
                    <h3>Quando</h3>
                    <a href="compras/detalhes.php">R$59,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71xF7YF2BsL._SY466_.jpg" alt="Bom Crioulo"></a>
                    <h3>Bom Crioulo</h3>
                    <a href="compras/detalhes.php">R$69,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71bWGcFrLCL._SL1500_.jpg" alt="A Teus Pés"></a>
                    <h3>A Teus Pés</h3>
                    <a href="compras/detalhes.php">R$79,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/91ADwCpigxL._SL1500_.jpg" alt=" Véspera"></a>
                    <h3> Véspera</h3>
                    <a href="compras/detalhes.php">R$119,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71AYPfbv2BL._SL1500_.jpg" alt="Morte e vida severina"></a>
                    <h3>Morte e vida severina</h3>
                    <a href="compras/detalhes.php">R$49,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81Pp8Zed8IL._SL1500_.jpg" alt="Eles não usam black-tie"></a>
                    <h3>Eles não usam black-tie</h3>
                    <a href="compras/detalhes.php">R$89,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/61x1ZHomWUL._SY466_.jpg" alt="Dom Casmurro"></a>
                    <h3>Dom Casmurro</h3>
                    <a href="compras/detalhes.php">R$49,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81e94f06FcL._SL1500_.jpg" alt=" Perto do coração selvagem : Edição comemorativa"></a>
                    <h3> Perto do coração selvagem : Edição comemorativa</h3>
                    <a href="compras/detalhes.php">R$59,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71kzs3gIwpL._SY466_.jpg" alt=" Morangos mofados"></a>
                    <h3> Morangos mofados</h3>
                    <a href="compras/detalhes.php">R$39,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/714yEGAjivL._SL1500_.jpg" alt="Quinze Dias"></a>
                    <h3>Quinze Dias</h3>
                    <a href="compras/detalhes.php">R$69,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81PX7q67zDL._SL1500_.jpg" alt="Hoje Eu Quero Voltar Sozinho"></a>
                    <h3>Hoje Eu Quero Voltar Sozinho</h3>
                    <a href="compras/detalhes.php">R$49,90</a>
                </article>
            </div>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>

        <section class="categoria">
            <div class="titulo">
                <h2>Romance fantástico</h2>
                <span>›</span>
            </div>

            <button class="seta seta-esquerda" type="button" aria-label="Anterior">‹</button>

            <div class="livros">
                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81XqiNjr5OL._SL1500_.jpg " alt=" Suicidas"></a>
                    <h3> Suicidas</h3>
                    <a href="compras/detalhes.php">R$59,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71AeB1+8dZL._SL1500_.jpg" alt="Jantar secreto"></a>
                    <h3>Jantar secreto</h3>
                    <a href="compras/detalhes.php">R$69,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71nbAlbz1tL._SY466_.jpg" alt=" Uma mulher no escuro"></a>
                    <h3> Uma mulher no escuro</h3>
                    <a href="compras/detalhes.php">R$49,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/61k-lrleRAL._SL1500_.jpg" alt="Bom Dia, Verônica"></a>
                    <h3>Bom Dia, Verônica </h3>
                    <a href="compras/detalhes.php">R$79,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71Uw783uI5L._SL1500_.jpg " alt="Elize Matsunaga: A Mulher que Matou o Marido"></a>
                    <h3>Elize Matsunaga: A Mulher que Matou o Marido</h3>
                    <a href="compras/detalhes.php">R$119,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/91sOa8t-JuL._SL1500_.jpg" alt="Flordelis: A Pastora do Diabo"></a>
                    <h3>Flordelis: A Pastora do Diabo</h3>
                    <a href="compras/detalhes.php">R$49,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71-YhujYUxS._SL1500_.jpg" alt=" A Cabeça do Santo"></a>
                    <h3> A Cabeça do Santo</h3>
                    <a href="compras/detalhes.php">R$33,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71OH6jq5QJL._SL1358_.jpg " alt=" Casa de Alvenaria - Volume 1: Osasco"></a>
                    <h3> Casa de Alvenaria - Volume 1: Osasco</h3>
                    <a href="compras/detalhes.php">R$59,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/91u1X7IttSL._SL1500_.jpg" alt="Ou Isto ou Aquilo"></a>
                    <h3>Ou Isto ou Aquilo</h3>
                    <a href="compras/detalhes.php">R$59,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/71nCJmJiXgL._SL1500_.jpg" alt="As Mentiras que os Homens Contam"></a>
                    <h3>As Mentiras que os Homens Contam</h3>
                    <a href="compras/detalhes.php">R$69,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81L2LaymKIL._SL1500_.jpg" alt="As Mentiras que as Mulheres Contam"></a>
                    <h3>As Mentiras que as Mulheres Contam</h3>
                    <a href="compras/detalhes.php">R$49,90</a>
                </article>

                <article class="livro">
                    <a href="compras/detalhes.php"><img src="https://m.media-amazon.com/images/I/81WjGu5a5ZL._SL1500_.jpg " alt="Uma família feliz"></a>
                    <h3>Uma família feliz</h3>
                    <a href="compras/detalhes.php">R$119,90</a>
                </article>
            </div>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>

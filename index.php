<?php
   session_start();
   require_once "config/database.php";


   $totalItensCarrinho = 0;
   if(isset($_SESSION['carrinho'])) {
       foreach ($_SESSION['carrinho'] as $item) {
           $totalItensCarrinho += $item['quantidade'];
       }
   }

    $sqlRomance = " SELECT DISTINCT l.* FROM livro l INNER JOIN liv_cat lc ON l.id_liv = lc.id_liv INNER JOIN categoria c ON lc.id_cat = c.id_cat WHERE c.nome_cat LIKE '%Romance%' ORDER BY l.titulo_liv";
    $resultadoRomance = $conexao->query($sqlRomance);


    $sqlSuspense = " SELECT DISTINCT l.* FROM livro l INNER JOIN liv_cat lc ON l.id_liv = lc.id_liv INNER JOIN categoria c ON lc.id_cat = c.id_cat WHERE c.nome_cat LIKE '%Suspense%' OR c.nome_cat LIKE '%Terror%' OR c.nome_cat LIKE '%Thriller%' OR c.nome_cat LIKE '%Horror%' ORDER BY l.titulo_liv";
    $resultadoSuspense = $conexao->query($sqlSuspense);


    $sqlContos = " SELECT DISTINCT l.* FROM livro l INNER JOIN liv_cat lc ON l.id_liv = lc.id_liv INNER JOIN categoria c ON lc.id_cat = c.id_cat WHERE c.nome_cat LIKE '%Conto%' OR c.nome_cat LIKE '%Cronica%' OR c.nome_cat LIKE '%Crônica%' ORDER BY l.titulo_liv";
    $resultadoContos = $conexao->query($sqlContos);


    $sqlNaoficcao = " SELECT DISTINCT l.* FROM livro l INNER JOIN liv_cat lc ON l.id_liv = lc.id_liv INNER JOIN categoria c ON lc.id_cat = c.id_cat WHERE c.nome_cat IN ('Diário', 'Autobiografia', 'Testemunho Histórico', 'Jornalismo Investigativo', 'Biografia / True Crime', 'Literatura de Testemunho', 'Ensaio', 'Reflexão Socioambiental') ORDER BY l.titulo_liv";
    $resultadoNaoficcao = $conexao->query($sqlNaoficcao);


    $sqlliteraturainfantil = " SELECT DISTINCT l.* FROM livro l INNER JOIN liv_cat lc ON l.id_liv = lc.id_liv INNER JOIN categoria c ON lc.id_cat = c.id_cat WHERE c.nome_cat LIKE '%Infantil%' ORDER BY l.titulo_liv";
    $resultadoLiteraturainfantil = $conexao->query($sqlliteraturainfantil);


    $sqlDrama = " SELECT DISTINCT l.* FROM livro l INNER JOIN liv_cat lc ON l.id_liv = lc.id_liv INNER JOIN categoria c ON lc.id_cat = c.id_cat WHERE c.nome_cat LIKE '%Drama%' ORDER BY l.titulo_liv";
    $resultadoDrama = $conexao->query($sqlDrama);


    $sqlPoesia = " SELECT DISTINCT l.* FROM livro l INNER JOIN liv_cat lc ON l.id_liv = lc.id_liv INNER JOIN categoria c ON lc.id_cat = c.id_cat WHERE c.nome_cat LIKE '%Poesia%' ORDER BY l.titulo_liv";
    $resultadoPoesia = $conexao->query($sqlPoesia);
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
            <a href="index.php">Home</a>
            <a href="sobreNos.php">Sobre nós</a>
            <a href="maisProcurados.php">+ Procurados</a>
            <a href="novidades.php">Novidades</a>
        </nav>

        <div class="header-actions">
            <label class="search-box" aria-label="Pesquisar livro">
                <span aria-hidden="true">⌕</span>
                <input type="search" id="inputPesquisa" placeholder="Pesquisar..." aria-label="Pesquisar livro">
            </label>

            <div class="header-actions">
                <div class="user-tools">
                    <a href="carrinho.php" aria-label="Carrinho de compras" class="carrinho-perfil-png">
                        <img src="img/carrinho.png" alt="Arandu">
                    </a>
                    <a href="usuario/perfil.php" aria-label="Perfil do usuário" class="carrinho-perfil-png">
                        <img src="img/perfil.png" alt="Arandu">
                    </a>
                </div>
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
                <?php while($livro = $resultadoRomance->fetch_assoc()){ ?>
                    <article class="livro">
                        <a href="compras/detalhes.php?id=<?php echo $livro['id_liv']; ?>">
                            <img src="<?php echo $livro['imagem']; ?>" alt="<?php echo $livro['titulo_liv']; ?>">
                        </a>
                        <h3><?php echo $livro['titulo_liv']; ?></h3>
                        <p>R$ <?php echo number_format($livro['preco'], 2, ',', '.'); ?></p>
                    </article>
                <?php } ?>
            </div>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>


        <section class="categoria">
            <div class="titulo">
                <h2>Suspense, terror e thriller</h2>
                <span>›</span>
            </div>
            <button class="seta seta-esquerda" type="button" aria-label="Anterior">‹</button>
            <div class="livros">
                <?php while($livro = $resultadoSuspense->fetch_assoc()){ ?>
                    <article class="livro">
                        <a href="compras/detalhes.php?id=<?php echo $livro['id_liv']; ?>">
                            <img src="<?php echo $livro['imagem']; ?>" alt="<?php echo $livro['titulo_liv']; ?>">
                        </a>
                        <h3><?php echo $livro['titulo_liv']; ?></h3>
                        <p>R$ <?php echo number_format($livro['preco'], 2, ',', '.'); ?></p>
                    </article>
                <?php } ?>
            </div>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>


        <section class="categoria">
            <div class="titulo">
                <h2>Contos e crônicas</h2>
                <span>›</span>
            </div>
            <button class="seta seta-esquerda" type="button" aria-label="Anterior">‹</button>
            <div class="livros">
                <?php while($livro = $resultadoContos->fetch_assoc()){ ?>
                    <article class="livro">
                        <a href="compras/detalhes.php?id=<?php echo $livro['id_liv']; ?>">
                            <img src="<?php echo $livro['imagem']; ?>" alt="<?php echo $livro['titulo_liv']; ?>">
                        </a>
                        <h3><?php echo $livro['titulo_liv']; ?></h3>
                        <p>R$ <?php echo number_format($livro['preco'], 2, ',', '.'); ?></p>
                    </article>
                <?php } ?>
            </div>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>


        <section class="categoria">
            <div class="titulo">
                <h2>Não ficção</h2>
                <span>›</span>
            </div>
            <button class="seta seta-esquerda" type="button" aria-label="Anterior">‹</button>
            <div class="livros">
                <?php while($livro = $resultadoNaoficcao->fetch_assoc()){ ?>
                    <article class="livro">
                        <a href="compras/detalhes.php?id=<?php echo $livro['id_liv']; ?>">
                            <img src="<?php echo $livro['imagem']; ?>" alt="<?php echo $livro['titulo_liv']; ?>">
                        </a>
                        <h3><?php echo $livro['titulo_liv']; ?></h3>
                        <p>R$ <?php echo number_format($livro['preco'], 2, ',', '.'); ?></p>
                    </article>
                <?php } ?>
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
                <?php while($livro = $resultadoLiteraturainfantil->fetch_assoc()){ ?>
                    <article class="livro">
                        <a href="compras/detalhes.php?id=<?php echo $livro['id_liv']; ?>">
                            <img src="<?php echo $livro['imagem']; ?>" alt="<?php echo $livro['titulo_liv']; ?>">
                        </a>
                        <h3><?php echo $livro['titulo_liv']; ?></h3>
                        <p>R$ <?php echo number_format($livro['preco'], 2, ',', '.'); ?></p>
                    </article>
                <?php } ?>
            </div>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>


        <section class="categoria">
            <div class="titulo">
                <h2>Drama</h2>
                <span>›</span>
            </div>
            <button class="seta seta-esquerda" type="button" aria-label="Anterior">‹</button>
            <div class="livros">
                <?php while($livro = $resultadoDrama->fetch_assoc()){ ?>
                    <article class="livro">
                        <a href="compras/detalhes.php?id=<?php echo $livro['id_liv']; ?>">
                            <img src="<?php echo $livro['imagem']; ?>" alt="<?php echo $livro['titulo_liv']; ?>">
                        </a>
                        <h3><?php echo $livro['titulo_liv']; ?></h3>
                        <p>R$ <?php echo number_format($livro['preco'], 2, ',', '.'); ?></p>
                    </article>
                <?php } ?>
            </div>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>


        <section class="categoria">
            <div class="titulo">
                <h2>Poesia</h2>
                <span>›</span>
            </div>
            <button class="seta seta-esquerda" type="button" aria-label="Anterior">‹</button>
            <div class="livros">
                <?php while($livro = $resultadoPoesia->fetch_assoc()){ ?>
                    <article class="livro">
                        <a href="compras/detalhes.php?id=<?php echo $livro['id_liv']; ?>">
                            <img src="<?php echo $livro['imagem']; ?>" alt="<?php echo $livro['titulo_liv']; ?>">
                        </a>
                        <h3><?php echo $livro['titulo_liv']; ?></h3>
                        <p>R$ <?php echo number_format($livro['preco'], 2, ',', '.'); ?></p>
                    </article>
                <?php } ?>
            </div>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>
    </main>
    <script src="js/script.js"></script>
</body>
</html>

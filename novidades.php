<?php
    session_start();
    require_once "config/database.php";

    $totalItensCarrinho = 0;
    if(isset($_SESSION['carrinho'])) {
        foreach ($_SESSION['carrinho'] as $item) {
            $totalItensCarrinho += $item['quantidade'];
        }
    }

    $sqlLivro = "SELECT l.id_liv, l.titulo_liv, l.preco, l.imagem, l.ano_public,
            GROUP_CONCAT(DISTINCT a.nome_aut SEPARATOR ', ') AS nome_aut
            FROM livro l
            LEFT JOIN liv_aut la ON l.id_liv = la.id_liv
            LEFT JOIN autor a ON la.id_aut = a.id_aut
            WHERE l.ano_public >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)
            AND l.ano_public <= CURDATE()
            GROUP BY l.id_liv
            ORDER BY l.ano_public DESC";

    $resultadoLivro = $conexao->query($sqlLivro);
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
            <label class="search-box" aria-label="Pesquisar livro">
                <span aria-hidden="true">⌕</span>
                <input type="search" id="inputPesquisa" placeholder="Pesquisar..." aria-label="Pesquisar livro">
            </label>

            <div class="header-actions">
                <div class="user-tools">
                    <a href="carrinho.php" class="header-button cart-link" aria-label="Carrinho de compras">
                        <span aria-hidden="true">🛍</span>
                    </a>
                    <a href="login.php" class="header-button login-link">Entrar</a>
                    <a href="usuario/perfil.php" class="header-button admin-link">
                        <span aria-hidden="true">👤</span>
                        <span></span>
                    </a>
                </div>
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
                <?php if($resultadoLivro && $resultadoLivro->num_rows > 0):?>
                <?php while($livro = $resultadoLivro->fetch_assoc()):?>

                <article class="livro">

                    <a href="compras/detalhes.php?id=<?=$livro['id_liv']?>">
                    <img src="<?= htmlspecialchars($livro['imagem'] ?? '')?>" alt="<?= htmlspecialchars($livro['titulo_liv'])?>"></a>
                    <h3>"<?= htmlspecialchars($livro['titulo_liv']) ?>"</h3>

                    <form action="compras/detalhes.php?id=<?=$livro['id_liv']?>" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="<?=$livro['id_liv']?>">
                        <input type="hidden" name="nome" value="<?=htmlspecialchars($livro['titulo_liv'])?>">
                        <input type="hidden" name="preco" value="<?=$livro['preco']?>">
                        <input type="hidden" name="imagem" value="<?=htmlspecialchars($livro['imagem'])?>">
                        <input type="hidden" name="autor" value="<?=htmlspecialchars($livro['nome_aut']) ?>">
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">R$ <?= number_format($livro['preco'], 2, ',', '.') ?></button>
                    </form>

                </article>
                <?php endwhile; ?>
                <?php else: ?><p>Nenhuma novidade encontrada no momento.</p><?php endif; ?>
            </div>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>

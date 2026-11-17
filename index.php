<?php
    session_start();
    require_once "config/database.php";

    $totalItensCarrinho = 0;
    if(isset($_SESSION['carrinho'])) {
        foreach ($_SESSION['carrinho'] as $item) {
            $totalItensCarrinho += $item['quantidade'];
        }
    }

    $dadosCategoria = [];

    $sqlCat = "SELECT * FROM categoria ORDER BY nome_cat";
    $resultadoCat = $conexao->query($sqlCat);

    if($resultadoCat){
        while($categoria = $resultadoCat->fetch_assoc()){
            $id_categoria = $categoria['id_cat'];
            $nome_categoria = $categoria['nome_cat'];

            $sqlLivros = "SELECT l.id_liv, l.titulo_liv, l.preco, l.imagem,
                          GROUP_CONCAT(DISTINCT a.nome_aut SEPARATOR ', ') AS nome_aut
                          FROM livro l
                          INNER JOIN liv_cat lc ON l.id_liv = lc.id_liv
                          INNER JOIN liv_aut la ON l.id_liv = la.id_liv
                          INNER JOIN autor a ON la.id_aut = a.id_aut
                          WHERE lc.id_cat = ?
                          GROUP BY l.id_liv
                          ORDER BY l.titulo_liv";
            
            $stmt = $conexao->prepare($sqlLivros);
            $stmt->bind_param("i", $id_categoria);
            $stmt->execute();

            $resultadoLivros = $stmt->get_result();

            $livros = [];

            while($livro = $resultadoLivros->fetch_assoc()){
                $livros[] = $livro;
            }

            $stmt->close();

            if(!empty($livros)){
                $dadosCategoria[] = ['nome_cat' => $nome_categoria, 'livros'=> $livros];
            }
        }
    }

    usort($dadosCategoria, function($a, $b){
        return count($b['livros']) <=> count($a['livros']);
    });
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
        <?php foreach($dadosCategoria as $categoria): ?>
        <section class="categoria">
            <div class="titulo">
                <h2><?htmlspecialchars($categoria['nome_cat'])?></h2>
                <span>›</span>
            </div>

            <button class="seta seta-esquerda" type="button" aria-label="Anterior">‹</button>

            <div class="livros">
                <?php foreach($categoria['livros'] as $livro): ?>
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
                <?php endforeach; ?>
            </div>
            <button class="seta seta-direita" type="button" aria-label="Próximo">›</button>
            <?php endforeach; ?>
        </section>
    <script src="js/script.js"></script>
</body>
</html>

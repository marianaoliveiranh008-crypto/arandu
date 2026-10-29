<?php
    session_start();
    require_once "../config/database.php";

    if(isset($_GET['id'])){
        $id_livro = $_GET['id'];

        $sqli = "SELECT l.*, ed.nome_edi,
                GROUP_CONCAT(DISTINCT c.nome_cat SEPARATOR ', ') AS nome_cat, 
                GROUP_CONCAT(DISTINCT a.nome_aut SEPARATOR ', ') AS autor
                FROM livro l
                LEFT JOIN editora ed ON l.id_edi = ed.id_edi
                LEFT JOIN liv_cat lc ON l.id_liv = lc.id_liv
                LEFT JOIN categoria c ON lc.id_cat = c.id_cat
                LEFT JOIN liv_aut la ON l.id_liv = la.id_liv 
                LEFT JOIN autor a ON la.id_aut = a.id_aut
                WHERE l.id_liv = ?
                GROUP BY l.id_liv";
        $stmt = $conexao->prepare($sqli);
        $stmt->bind_param("i", $id_livro);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if($resultado->num_rows>0){
            $livro = $resultado->fetch_assoc();
        }else{
            die("Livro não encontrado!");
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livro</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="detalhes-page">
    <header class="top-header">
        <a class="brand" href="../index.php" aria-label="Arandu - página inicial">
            <img src="../img/logo.png" alt="Arandu">
        </a>

        <nav class="nav-menu" aria-label="Menu principal">
            <a href="../index.php">Home</a>
            <a href="../sobreNos.php">Sobre nós</a>
            <a href="../index.php">+ Procurados</a>
            <a href="../index.php">Novidades</a>
        </nav>

        <div class="header-actions">
            <div class="user-tools">
                <a href="../carrinho.php" class="header-button cart-link" aria-label="Carrinho de compras">
                    <span aria-hidden="true">🛍</span>
                </a>
                <a href="../login.php" class="header-button login-link">Entrar</a>
                <a href="../usuario/perfil.php" class="header-button admin-link" aria-label="Perfil">
                    <span aria-hidden="true">👤</span>
                </a>
            </div>
        </div>
    </header>

    <main class="detalhes-main">
        <article class="detalhes-card">
            <img
                class="detalhes-capa"
                src="<?= htmlspecialchars($livro['imagem'] ?? '') ?>"
                alt="Capa do livro <?= htmlspecialchars($livro['titulo_liv'] ?? '') ?>">

            <div class="detalhes-conteudo">
                <h1><?= htmlspecialchars($livro['titulo_liv'] ?? '') ?></h1>
                <p class="detalhes-autor">Por: <?= htmlspecialchars($livro['autor'] ?? '') ?></p>

                <p class="detalhes-descricao">
                    <?= nl2br(htmlspecialchars($livro['descricao'] ?? 'Descrição não disponível.')) ?>
                </p>

                <div class="detalhes-metadados">
                    <div>Editora: <?= htmlspecialchars($livro['nome_edi'] ?? 'Não informada') ?></div>
                    <div>Categoria: <?= htmlspecialchars($livro['nome_cat'] ?? 'Não informada') ?></div>
                    <div>Publicado em: <?= htmlspecialchars($livro['ano_public'] ?? 'Data não informada') ?></div>
                </div>

                <div class="detalhes-compra">
                    <p class="detalhes-preco"><span>R$</span> <?= number_format($livro['preco'], 2, ',', '.') ?></p>
                
                    <form action="../carrinho.php" method="POST">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="id_livro" value="<?= htmlspecialchars($livro['id_liv'] ?? '') ?>">
                        <input type="hidden" name="nome" value="<?= htmlspecialchars($livro['titulo_liv'] ?? '') ?>">
                        <input type="hidden" name="preco" value="<?= htmlspecialchars($livro['preco'] ?? '') ?>">
                        <input type="hidden" name="imagem" value="<?= htmlspecialchars($livro['imagem'] ?? '') ?>">
                        <input type="hidden" name="autor" value="<?= htmlspecialchars($livro['autor'] ?? '') ?>">
                        <button type="submit" class="detalhes-comprar" style="border:none; cursor:pointer;">Adicionar ao carrinho</button>
                    </form>
                </div>
            </div>
        </article>
    </main>
</body>
</html>
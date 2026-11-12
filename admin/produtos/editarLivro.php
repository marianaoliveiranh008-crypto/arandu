<?php
    session_start();
    require_once "../../config/database.php";

    $id_livro = $_POST['id_livro'] ?? $_POST['id'] ?? 1;

    $sql = "SELECT l.id_liv, l.isbn, l.titulo_liv, l.descricao, l.ano_public, l.numero_pag, l.quanti_estoq, l.imagem, l.preco, l.id_edi,
                   e.nome_edi, a.id_aut, a.nome_aut
            FROM livro l
            LEFT JOIN editora e ON l.id_edi = e.id_edi
            LEFT JOIN liv_aut la ON l.id_liv = la.id_liv
            LEFT JOIN autor a ON la.id_aut = a.id_aut
            WHERE l.id_liv = ?";
            
    $stmt = $conexao->prepare($sql);

    if($stmt){
        $stmt->bind_param("i", $id_livro);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $livro = $result->fetch_assoc();

        $stmt->close();
    } else {
        die("Erro no prepare da consulta: ".$conexao->error);
    }

    if(!$livro){
        die("Livro não encontrado.");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro - Arandu</title>
    <link rel="stylesheet" href="../../css/style.css?v=11">
    <link rel="icon" href="../../img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="admin-page usuarios-page editar-livro-page">
    <header class="cabecalho">
        <a class="marca" href="../index.php" aria-label="Arandu - página inicial">
            <img src="../../img/logo.png" alt="Arandu">
        </a>

        <nav class="menu" aria-label="Navegação administrativa">
            <a href="../produtos/indexLivros.php">Livros</a>
            <a href="../pedidos/indexPedidos.php">Pedidos</a>
            <a href="../usuarios/listaUsuarios.php">Clientes</a>
            <a href="../produtos/estoqueLivros.php">Estoque</a>
        </nav>

        <nav class="atalhos" aria-label="Atalhos">
            <a href="../../usuario/perfil.php" aria-label="Perfil" title="Perfil">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M5 21v-2a7 7 0 0 1 14 0v2" />
                </svg>
            </a>
        </nav>
    </header>

    <main class="editar-livro-conteudo">
        <section class="editar-livro-cartao" aria-labelledby="editar-livro-titulo">
            <h1 id="editar-livro-titulo">Editar informações do livro</h1>

            <form class="editar-livro-form" action="indexLivros.php" method="POST">
                <input type="hidden" name="id_liv" value="<?= $id_livro ?>">

                <div class="editar-livro-campos">
                    <p class="editar-livro-campo">
                        <label for="titulo-liv">Título do livro</label>
                        <input id="titulo-liv" type="text" name="titulo_liv" value="<?= htmlspecialchars($livro['titulo_liv'] ?? '') ?>" required>
                    </p>
                    <p class="editar-livro-campo">
                        <label for="isbn">ISBN</label>
                        <input id="isbn" type="text" name="isbn" value="<?= htmlspecialchars($livro['isbn'] ?? '') ?>" required>
                    </p>
                    <p class="editar-livro-campo">
                        <label for="nome-aut">Autor</label>
                        <input id="nome-aut" type="text" name="nome_aut" value="<?= htmlspecialchars($livro['nome_aut'] ?? '') ?>">
                    </p>
                    <p class="editar-livro-campo">
                        <label for="nome-edi">Editora</label>
                        <input id="nome-edi" type="text" name="nome_edi" value="<?= htmlspecialchars($livro['nome_edi'] ?? '') ?>">
                    </p>
                    <p class="editar-livro-campo editar-livro-campo--wide">
                        <label for="descricao">Descrição</label>
                        <textarea id="descricao" name="descricao" rows="4" required><?= htmlspecialchars($livro['descricao'] ?? '') ?></textarea>
                    </p>
                    <p class="editar-livro-campo">
                        <label for="preco">Preço (R$)</label>
                        <input id="preco" type="number" step="0.01" name="preco" value="<?= htmlspecialchars($livro['preco'] ?? '0.00') ?>" required>
                    </p>
                    <p class="editar-livro-campo">
                        <label for="estoque">Quantidade em estoque</label>
                        <input id="estoque" type="number" name="quanti_estoq" value="<?= htmlspecialchars($livro['quanti_estoq'] ?? '0') ?>" required>
                    </p>
                    <p class="editar-livro-campo">
                        <label for="numero-pag">Número de páginas</label>
                        <input id="numero-pag" type="number" name="numero_pag" value="<?= htmlspecialchars($livro['numero_pag'] ?? '') ?>">
                    </p>
                    <p class="editar-livro-campo">
                        <label for="ano-public">Ano de publicação</label>
                        <input id="ano-public" type="date" name="ano_public" value="<?= htmlspecialchars($livro['ano_public'] ?? '') ?>">
                    </p>
                    <p class="editar-livro-campo editar-livro-campo--wide">
                        <label for="imagem">Imagem (caminho/URL)</label>
                        <input id="imagem" type="text" name="imagem" value="<?= htmlspecialchars($livro['imagem'] ?? '') ?>">
                    </p>
                </div>

                <div class="editar-livro-acoes">
                    <button class="editar-livro-salvar" type="submit">Salvar alterações</button>
                </div>
            </form>

            <form class="editar-livro-excluir" action="atualizarLivro.php" method="POST">
                <input type="hidden" name="id_liv" value="<?= $id_livro ?>">
                <button type="submit">Excluir livro</button>
            </form>
        </section>
    </main>
</body>
</html>
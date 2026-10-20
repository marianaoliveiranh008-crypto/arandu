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
    <link rel="stylesheet" href="../../css/style.css?v=2">
</head>
<body class="usuarios-page">
    <header class="top-header login-header">
        <a class="brand" href="../../index.php" aria-label="Arandu - página inicial">
            <img src="../../img/logo.png" alt="Arandu">
        </a>

        <nav class="nav-menu" aria-label="Navegação administrativa">
            <a href="../produtos/indexLivros.php">Livros</a>
            <a href="../../compras/historico.php">Pedidos</a>
            <a class="ativo" href="../usuarios/listaUsuarios.php" aria-current="page">Clientes</a>
            <a href="../produtos/listaLivros.php">Estoque</a>
        </nav>

        <nav class="usuarios-atalhos" aria-label="Atalhos">
            <a href="../../index.php" aria-label="Página inicial" title="Página inicial">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1z" /></svg>
            </a>
            <a href="#notificacoes" aria-label="Notificações" title="Notificações">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4" /></svg>
            </a>
            <a href="../../usuario/perfil.php" aria-label="Perfil" title="Perfil">
                <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4" /><path d="M5 21v-2a7 7 0 0 1 14 0v2" /></svg>
            </a>
        </nav>
    </header>

    <main class="usuarios-content">
        <h1>Editar Informações do Livro</h1>

        <form action="listaLivros.php" method="POST">
            <input type="hidden" name="id_liv" value="<?= $id_livro ?>">

            <div>
                <div>
                    <p>
                        <strong>Título do Livro:</strong><br>
                        <input type="text" name="titulo_liv" value="<?= htmlspecialchars($livro['titulo_liv'] ?? '') ?>" required>
                    </p>
                    <p>
                        <strong>ISBN:</strong><br>
                        <input type="text" name="isbn" value="<?= htmlspecialchars($livro['isbn'] ?? '') ?>" required>
                    </p>
                    <p>
                        <strong>Autor:</strong><br>
                        <input type="text" name="nome_aut" value="<?= htmlspecialchars($livro['nome_aut'] ?? '') ?>">
                    </p>
                    <p>
                        <strong>Editora:</strong><br>
                        <input type="text" name="nome_edi" value="<?= htmlspecialchars($livro['nome_edi'] ?? '') ?>">
                    </p>
                    <p>
                        <strong>Descrição:</strong><br>
                        <textarea name="descricao" rows="4" required><?= htmlspecialchars($livro['descricao'] ?? '') ?></textarea>
                    </p>
                </div>
                <p>
                    <strong>Preço (R$):</strong><br>
                    <input type="number" step="0.01" name="preco" value="<?= htmlspecialchars($livro['preco'] ?? '0.00') ?>" required>
                </p>
                <p>
                    <strong>Quantidade em Estoque:</strong><br>
                    <input type="number" name="quanti_estoq" value="<?= htmlspecialchars($livro['quanti_estoq'] ?? '0') ?>" required>
                </p>
                <p>
                    <strong>Número de Páginas:</strong><br>
                    <input type="number" name="numero_pag" value="<?= htmlspecialchars($livro['numero_pag'] ?? '') ?>">
                </p>
                <p>
                    <strong>Ano de Publicação:</strong><br>
                    <input type="date" name="ano_public" value="<?= htmlspecialchars($livro['ano_public'] ?? '') ?>">
                </p>
                <p>
                    <strong>Imagem (Caminho/URL):</strong><br>
                    <input type="text" name="imagem" value="<?= htmlspecialchars($livro['imagem'] ?? '') ?>">
                </p>
            </div>

            <div>
                <button type="submit">Salvar alterações</button>
            </div>
        </form>

        <form action="atualizarLivro.php" method="POST">
            <input type="hidden" name="id_liv" value="<?= $id_livro ?>">
            <button type="submit">Excluir livro</button>
        </form>
    </main>
</body>
</html>
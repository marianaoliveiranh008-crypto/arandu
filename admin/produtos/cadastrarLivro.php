<?php
    session_start();
    require_once "../../config/database.php";
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
        <h1>Adicionar Livro</h1>

        <form action="indexLivros.php" method="POST">
            <input type="hidden" name="id_liv" value="<?= $id_livro ?>">

            <div>
                <div>
                    <p>
                        <strong>Título do Livro:</strong><br>
                        <input type="text" name="titulo_liv" required>
                    </p>
                    <p>
                        <strong>ISBN:</strong><br>
                        <input type="text" name="isbn" required>
                    </p>
                    <p>
                        <strong>Autor:</strong><br>
                        <input type="text" name="nome_aut" required>
                    </p>
                    <p>
                        <strong>Editora:</strong><br>
                        <input type="text" name="nome_edi" required>
                    </p>
                    <p>
                        <strong>Descrição:</strong><br>
                        <textarea name="descricao" rows="4" required></textarea>
                    </p>
                </div>
                <p>
                    <strong>Preço (R$):</strong><br>
                    <input type="number" step="0.01" name="preco" required>
                </p>
                <p>
                    <strong>Quantidade em Estoque:</strong><br>
                    <input type="number" name="quanti_estoq" required>
                </p>
                <p>
                    <strong>Número de Páginas:</strong><br>
                    <input type="number" name="numero_pag" required>
                </p>
                <p>
                    <strong>Ano de Publicação:</strong><br>
                    <input type="date" name="ano_public" required>
                </p>
                <p>
                    <strong>Imagem (Caminho/URL):</strong><br>
                    <input type="text" name="imagem">
                </p>
            </div>

            <form action="salvarLivro.php" method="POST">
                <input type="hidden" name="id_liv" value="<?= $id_livro ?>">
                <button type="submit">Salvar livro</button>
            </form>
        </form>
    </main>
</body>
</html>
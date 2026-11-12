<?php
    session_start();
    require_once "../../config/database.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livro - Arandu</title>
    <link rel="stylesheet" href="../../css/style.css?v=11">
    <link rel="icon" href="../../img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="admin-page usuarios-page cadastro-livro-page">
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

    <main class="cadastro-livro-conteudo">
        <section class="cadastro-livro-cartao" aria-labelledby="cadastro-livro-titulo">
            <h1 id="cadastro-livro-titulo">Adicionar livro</h1>

            <form class="cadastro-livro-form" action="indexLivros.php" method="POST">
                <input type="hidden" name="id_liv" value="<?= $id_livro ?>">
                <div class="cadastro-livro-campos">
                    <p class="cadastro-livro-campo">
                        <label for="titulo-liv">Título do livro</label>
                        <input id="titulo-liv" type="text" name="titulo_liv" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="isbn">ISBN</label>
                        <input id="isbn" type="text" name="isbn" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="nome-aut">Autor</label>
                        <input id="nome-aut" type="text" name="nome_aut" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="nome-edi">Editora</label>
                        <input id="nome-edi" type="text" name="nome_edi" required>
                    </p>
                    <p class="cadastro-livro-campo cadastro-livro-campo--wide">
                        <label for="descricao">Descrição</label>
                        <textarea id="descricao" name="descricao" rows="4" required></textarea>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="preco">Preço (R$)</label>
                        <input id="preco" type="number" step="0.01" name="preco" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="estoque">Quantidade em estoque</label>
                        <input id="estoque" type="number" name="quanti_estoq" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="numero-pag">Número de páginas</label>
                        <input id="numero-pag" type="number" name="numero_pag" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="ano-public">Ano de publicação</label>
                        <input id="ano-public" type="date" name="ano_public" required>
                    </p>
                    <p class="cadastro-livro-campo cadastro-livro-campo--wide">
                        <label for="imagem">Imagem (caminho/URL)</label>
                        <input id="imagem" type="text" name="imagem">
                    </p>
                </div>

                <div class="cadastro-livro-acoes">
                    <button type="submit">Salvar livro</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
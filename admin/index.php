<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de administração - Arandu</title>
    <link rel="stylesheet" href="../css/style.css?v=8">
</head>
<body class="admin-page">
    <header class="cabecalho">
        <a class="marca" href="../index.php" aria-label="Arandu - página inicial">
            <img src="../img/logo.png" alt="Arandu">
        </a>

        <nav class="menu" aria-label="Navegação administrativa">
            <a href="produtos/indexLivros.php">Livros</a>
            <a href="../compras/historico.php">Pedidos</a>
            <a href="usuarios/listaUsuarios.php">Clientes</a>
            <a href="produtos/estoqueLivros.php">Estoque</a>
        </nav>

        <nav class="atalhos" aria-label="Atalhos">
            <a href="../index.php" aria-label="Página inicial" title="Página inicial">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1z" />
                </svg>
            </a>
            <a href="#" aria-label="Notificações" title="Notificações">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4" />
                </svg>
            </a>
            <a href="../usuario/perfil.php" aria-label="Perfil" title="Perfil">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M5 21v-2a7 7 0 0 1 14 0v2" />
                </svg>
            </a>
        </nav>
    </header>

    <main class="painel">
        <h1>Painel de administração</h1>
        <section class="resumos" aria-label="Resumo da administração">
            <article class="cartao">
                <h2>Pedidos:</h2>
                <p>3 pedidos</p>
            </article>
            <article class="cartao">
                <h2>Produtos:</h2>
                <p>50 cadastrados</p>
            </article>
            <article class="cartao">
                <h2>Clientes:</h2>
                <p>3 cadastrados</p>
            </article>
            <article class="cartao">
                <h2>Estoque:</h2>
                <p>200 produtos em estoque</p>
            </article>
        </section>
    </main>
</body>
</html>
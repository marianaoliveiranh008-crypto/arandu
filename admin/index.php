<?php
    session_start();
    require_once "../config/database.php";

    $resultadoPedidos = mysqli_query($conexao, "SELECT * FROM pedido");
    $pedidos = mysqli_fetch_all($resultadoPedidos, MYSQLI_ASSOC);
    $totalPedidos = count($pedidos);

    $resultadoProdutos = mysqli_query($conexao, "SELECT * FROM livro");
    $produtos = mysqli_fetch_all($resultadoProdutos, MYSQLI_ASSOC);
    $totalProdutos = count($produtos);

    $resultadoClientes = mysqli_query($conexao, "SELECT * FROM usuario");
    $clientes = mysqli_fetch_all($resultadoClientes, MYSQLI_ASSOC);
    $totalClientes = count($clientes);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de administração - Arandu</title>
    <link rel="stylesheet" href="../css/style.css?v=10">
    <link rel="icon" href="img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="admin-page">
    <header class="cabecalho">
        <a class="marca" href="../index.php" aria-label="Arandu - página inicial">
            <img src="../img/logo.png" alt="Arandu">
        </a>

        <nav class="menu" aria-label="Navegação administrativa">
            <a href="produtos/indexLivros.php">Livros</a>
            <a href="pedidos/indexPedidos.php">Pedidos</a>
            <a href="usuarios/listaUsuarios.php">Clientes</a>
            <a href="produtos/estoqueLivros.php">Estoque</a>
        </nav>

        <nav class="atalhos" aria-label="Atalhos">
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
            <a href="pedidos/indexPedidos.php">
                <article class="cartao" action="pedidos/indexPedidos.php">
                    <h2>Pedidos:</h2>
                    <p><?= htmlspecialchars($totalPedidos)?> pedido(s)</p>
                </article>
            </a>

            <a href="produtos/indexLivros.php">
                <article class="cartao">
                    <h2>Produtos:</h2>
                    <p><?= htmlspecialchars($totalProdutos)?> produto(s)</p>
                </article>
            </a>

            <a href="usuarios/listaUsuarios.php">
                <article class="cartao">
                    <h2>Clientes:</h2>
                    <p><?= htmlspecialchars($totalClientes)?> cliente(s)</p>
                </article>
            </a>
        </section>
    </main>
</body>
</html>
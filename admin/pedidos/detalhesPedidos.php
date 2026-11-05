<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes dos pedidos - Arandu</title>
    <link rel="stylesheet" href="../../css/style.css?v=9">
</head>
<body class="admin-page admin-pedidos-page">
    <header class="cabecalho">
        <a class="marca" href="../index.php" aria-label="Arandu - página inicial">
            <img src="../img/logo.png" alt="Arandu">
        </a>

        <nav class="menu" aria-label="Navegação administrativa">
            <a href="../produtos/indexLivros.php">Livros</a>
            <a href="../pedidos/indexPedidos.php">Pedidos</a>
            <a href="../usuarios/listaUsuarios.php">Clientes</a>
            <a href="../produtos/estoqueLivros.php">Estoque</a>
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

    <main class="admin-pedidos-conteudo">
        <section class="admin-pedidos-caixa" aria-labelledby="pedido-titulo">
            <div class="pedido-detalhes">
                <h1 id="pedido-titulo">Pedido #003</h1>

                <div class="pedido-colunas">
                    <div class="pedido-coluna">
                        <section class="pedido-bloco">
                            <h2>Cliente:</h2>
                            <p>Victória Kerpel<br>victoria@email.com</p>
                        </section>

                        <section class="pedido-bloco">
                            <h2>Entrega:</h2>
                            <p>Rua Exemplo, 250<br>São Leopoldo - RS</p>
                        </section>

                        <section class="pedido-bloco">
                            <h2>Produtos:</h2>
                            <ul class="pedido-produtos">
                                <li>Capitães da Areia<br>Quantidade: 1<br>R$ 24,99</li>
                                <li>Torto Arado<br>Quantidade: 1<br>R$ 89,90</li>
                            </ul>
                        </section>
                    </div>

                    <div class="pedido-coluna">
                        <section class="pedido-bloco">
                            <h2>Status:</h2>
                            <ul class="pedido-status">
                                <li>✓ Realizado</li>
                                <li>✓ Pagamento aprovado</li>
                                <li class="status-atual">Enviado</li>
                                <li class="status-pendente">Entregue</li>
                            </ul>
                        </section>

                        <section class="pedido-bloco">
                            <h2>Pagamento:</h2>
                            <p>PIX</p>
                        </section>

                        <section class="pedido-bloco">
                            <h2>Total:</h2>
                            <p>R$129,89</p>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
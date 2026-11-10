<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos - Arandu</title>
    <link rel="stylesheet" href="../../css/style.css?v=10">
    <link rel="icon" href="../../img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="admin-page admin-pedidos-page">
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

    <main class="admin-pedidos-lista-conteudo">
        <section class="admin-pedidos-lista" aria-labelledby="pedidos-recentes-titulo">
            <label class="admin-pedidos-busca">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="11" cy="11" r="7" />
                    <path d="m16 16 5 5" />
                </svg>
                <span class="admin-pedidos-busca-divisor" aria-hidden="true"></span>
                <input type="search" placeholder="Buscar pedido ou cliente..." aria-label="Buscar pedido ou cliente">
            </label>

            <h1 id="pedidos-recentes-titulo">Pedidos recentes:</h1>

            <div class="admin-pedidos-tabela-scroll">
                <table class="admin-pedidos-tabela">
                    <thead>
                        <tr>
                            <th scope="col">Nº</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Data</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Pagamento</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#001</td>
                            <td>Mariana E. de<br>Oliveira</td>
                            <td>01/10/2026</td>
                            <td>R$50,00</td>
                            <td>Cartão de Crédito</td>
                            <td>Pago</td>
                            <td><a href="detalhesPedidos.php">Ver detalhes</a></td>
                        </tr>
                        <tr>
                            <td>#002</td>
                            <td>Luiza Favero</td>
                            <td>30/09/2026</td>
                            <td>R$50,00</td>
                            <td>Cartão de Débito</td>
                            <td>Pendente</td>
                            <td><a href="detalhesPedidos.php">Ver detalhes</a></td>
                        </tr>
                        <tr>
                            <td>#003</td>
                            <td>Victória Kerpel</td>
                            <td>29/09/2026</td>
                            <td>R$129,89</td>
                            <td>Pix</td>
                            <td>Enviado</td>
                            <td><a href="detalhesPedidos.php">Ver detalhes</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
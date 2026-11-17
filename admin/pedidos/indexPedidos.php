<?php
    session_start();
    require_once "../../config/database.php";

    $pesquisa = $_POST['busca'] ?? '';

    $sqlPedido = "SELECT p.id_ped, p.data_pedido, p.status_pe, p.valor_total, u.nome AS nome_cliente, pg.metodo_pag
                  FROM pedido p
                  INNER JOIN usuario u ON p.id_usuario = u.id_usuario
                  LEFT JOIN pagamento pg ON p.id_ped = pg.id_ped";

    if(!empty($pesquisa)){
        $palavra = mysqli_real_escape_string($conexao, $pesquisa);
        $sqlPedido .= " WHERE u.nome LIKE '%$palavra%' OR p.id_ped LIKE '%$palavra%'";
    }

    $sqlPedido .= " ORDER BY p.data_pedido DESC";

    $resultado = mysqli_query($conexao, $sqlPedido);

    if(!$resultado){
        die("Erro na consulta SQL: " . mysqli_error($conexao));
    }
?>
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

        <nav class="nav-menu" aria-label="Navegação administrativa">
            <a href="../produtos/indexLivros.php">Livros</a>
            <a href="../pedidos/indexPedidos.php">Pedidos</a>
            <a href="../usuarios/listaUsuarios.php">Clientes</a>
            <a href="../produtos/estoqueLivros.php">Estoque</a>
        </nav>

        <nav class="atalhos" aria-label="Atalhos">
            <a href="../perfilAdmin.php" aria-label="Perfil" title="Perfil">
                <img src="../../img/perfil.png" alt="Perfil">
            </a>
        </nav>
    </header>
    
    <main class="admin-pedidos-lista-conteudo">
        <section class="admin-pedidos-lista" aria-labelledby="pedidos-recentes-titulo">
            <form method="POST" action="indexPedidos.php">
                <label class="admin-pedidos-busca" style="cursor: pointer;">
                    <button type="submit" style="background: none; border: none; cursor: pointer; display: flex; align-items: center;">
                        <svg viewBox="0 0 24 24" aria-hidden="true" width="20" height="20">
                            <circle cx="11" cy="11" r="7" />
                            <path d="m16 16 5 5" />
                        </svg>
                    </button>
                    <span class="admin-pedidos-busca-divisor" aria-hidden="true"></span>
                    <input type="search" name="busca" value="<?= htmlspecialchars($pesquisa) ?>" placeholder="Buscar pedido ou cliente..." aria-label="Buscar pedido ou cliente">
                </label>
            </form>

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
                        <?php if($resultado && $resultado->num_rows > 0): ?>
                        <?php while($pedido = $resultado->fetch_assoc()): ?>
                        <?php
                            $id_ped = $pedido['id_ped'];
                            $numeroPedido = "#" . str_pad($id_ped, 3, '0', STR_PAD_LEFT);
                            $nomeCliente = htmlspecialchars($pedido['nome_cliente']);
                            $dataPedido = date('d/m/Y', strtotime($pedido['data_pedido']));
                            $valorTotal = "R$ " . number_format($pedido['valor_total'], 2, ',', '.');
                            $metodoPagamento = ucfirst(htmlspecialchars($pedido['metodo_pag'] ?? 'Não informado'));
                            $statusPedido = htmlspecialchars($pedido['status_pe']);
                        ?>
                        <tr>
                            <td><?=$numeroPedido?></td>
                            <td><?=$nomeCliente?></td>
                            <td><?=$dataPedido?></td>
                            <td><?=$valorTotal?></td>
                            <td><?=$metodoPagamento?></td>
                            <td><?=$statusPedido?></td>
                            <td><a href="detalhesPedidos.php?id=<?= $id_ped ?>">Ver detalhes</a></td>
                        </tr>
                        <?php endwhile; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 20px;">Nenhum produto encontrado.</td>
                        </tr>
                    </tbody>
                    <?php endif; ?>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
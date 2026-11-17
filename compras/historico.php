<?php
    session_start();
    require_once "../config/database.php";

    $id_usuario = $_SESSION['usuarioId'] ?? $_SESSION['usuario_id'] ?? null;
    if(!$id_usuario){
        header("Location: ../login.php");
        exit;
    }

    $sql = "SELECT p.id_ped, p.data_pedido, p.status_pe, pg.metodo_pag,l.titulo_liv,pi.quantidade_ped,pi.preco_unit
            FROM pedido p
            INNER JOIN pedido_item pi ON p.id_ped = pi.id_ped
            INNER JOIN livro l ON pi.id_liv = l.id_liv
            LEFT JOIN pagamento pg ON p.id_ped = pg.id_ped
            WHERE p.id_usuario = ?";
    
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $dados = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Compras - Arandu</title>
    <link rel="stylesheet" href="../css/style.css?v=10">
    <link rel="icon" href="../img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="admin-page usuarios-page">
    <header class="top-header">
        <div class="brand">
            <img src="../img/logo.png" alt="Arandu">
        </div>

        <nav class="nav-menu" aria-label="Menu principal">
            <a href="../index.php">Home</a>
            <a href="../sobreNos.php">Sobre nós</a>
            <a href="../maisProcurados.php">+ Procurados</a>
            <a href="../novidades.php">Novidades</a>
        </nav>

        <div class="header-actions">
            <div class="header-actions">
                <div class="user-tools">
                    <a href="../carrinho.php" class="header-button cart-link" aria-label="Carrinho de compras">
                        <span aria-hidden="true">🛍</span>
                    </a>
                    <a href="../login.php" class="header-button login-link">Entrar</a>
                    <a href="../usuario/perfil.php" class="header-button admin-link">
                        <span aria-hidden="true">👤</span>
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="usuarios-content">
        <h2>Meu Histórico de Compras</h2>
        <br>
        <div class="usuarios-table-scroll">
            <table class="usuarios-table">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Título do Livro</th>
                        <th>Data de compra</th>
                        <th>Valor (Qtd)</th>
                        <th>Pagamento</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($dados->num_rows > 0): ?>
                    <?php while($linha = $dados->fetch_assoc()): ?>
                        <?php
                            $id_ped = $linha['id_ped'];
                            $tituloLivro = htmlspecialchars($linha['titulo_liv']);
                            $quantidade = $linha['quantidade_ped'];
                            $dataCompra = date('d/m/Y H:i', strtotime($linha['data_pedido']));
                            $valorTotalItem = $linha['preco_unit'] * $quantidade;
                            $valor = "R$ " . number_format($valorTotalItem, 2, ',', '.') . " <small>({$quantidade}x)</small>";
                            $pagamento = ucfirst(htmlspecialchars($linha['metodo_pag'] ?? 'Não informado'));
                            $status = htmlspecialchars($linha['status_pe']);
                        ?>
                        <tr>
                            <td>#<?= $id_ped ?></td>
                            <td><?= $tituloLivro ?></td>
                            <td><?= $dataCompra ?></td>
                            <td><?= $valor ?></td>
                            <td><?= $pagamento ?></td>
                            <td><?= $status ?></td>
                            <td><a class="perfil-link" href="detalhesPedidoCliente.php?id=<?= $id_ped ?>">Ver pedido</a></td>
                        </tr>
                        <?php endwhile; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 20px;">Nenhum produto encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
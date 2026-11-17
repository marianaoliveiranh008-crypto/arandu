<?php
    session_start();
    require_once "../../config/database.php";

    $id_pedido = $_GET['id'] ?? null;
    if(!$id_pedido){
        die("Erro: Pedido não especificado.");
    }

    $sqlPedido = "SELECT p.id_ped, p.data_pedido, p.status_pe, p.valor_total, p.valor_frete,u.nome
                  AS nome_cliente, u.email
                  AS email_cliente,e.rua, e.numero, e.complemento, e.bairro, e.cidade, e.estado, e.cep, pg.metodo_pag, pg.status_pag
                  FROM pedido p
                  INNER JOIN usuario u ON p.id_usuario = u.id_usuario
                  INNER JOIN endereco e ON p.id_end = e.id_end
                  LEFT JOIN pagamento pg ON p.id_ped = pg.id_ped
                  WHERE p.id_ped = ?";

    $stmt = $conexao->prepare($sqlPedido);
    $stmt->bind_param("i", $id_pedido);
    $stmt->execute();
    $resultadoPedido = $stmt->get_result();
    $pedido = $resultadoPedido->fetch_assoc();
    $stmt->close();

    if(!$pedido){
        die("Erro: Pedido não encontrado.");
    }

    $sqlItem = "SELECT pi.quantidade_ped, pi.preco_unit, l.titulo_liv 
                 FROM pedido_item pi
                 INNER JOIN livro l ON pi.id_liv = l.id_liv
                 WHERE pi.id_ped = ?";

    $stmtItem = $conexao->prepare($sqlItem);
    $stmtItem->bind_param("i", $id_pedido);
    $stmtItem->execute();
    $resultadoItem = $stmtItem->get_result();
    $stmtItem->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes dos pedidos - Arandu</title>
    <link rel="stylesheet" href="../../css/style.css?v=9">
    <link rel="icon" href="img/Logotipo-Livraria.ico" type="image/x-icon">
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
                <h1 id="pedido-titulo">Pedido #<?=str_pad($pedido['id_ped'], 3, '0', STR_PAD_LEFT)?></h1>

                <div class="pedido-colunas">
                    <div class="pedido-coluna">
                        <section class="pedido-bloco">
                            <h2>Cliente:</h2>
                            <p>
                                <?=htmlspecialchars($pedido['nome_cliente'])?>
                                <br>
                                <?=htmlspecialchars($pedido['email_cliente'])?>
                            </p>
                        </section>

                        <section class="pedido-bloco">
                            <h2>Entrega:</h2>
                            <p><?=htmlspecialchars($pedido['rua']) ?>, <?=htmlspecialchars($pedido['numero'])?>
                                <?php if(!empty($pedido['complemento'])) echo " - ".htmlspecialchars($pedido['complemento']);?>
                                <br>
                                <?=htmlspecialchars($pedido['cidade'])?> - <?=htmlspecialchars($pedido['estado']) ?>
                                <br>
                                CEP: <?=htmlspecialchars($pedido['cep']) ?>
                            </p>
                        </section>

                        <section class="pedido-bloco">
                            <h2>Produtos:</h2>
                            <ul class="pedido-produtos">
                                <?php while($item = $resultadoItem->fetch_assoc()): ?>
                                    <li>
                                        <?=htmlspecialchars($item['titulo_liv']) ?><br>
                                        Quantidade: <?=$item['quantidade_ped'] ?><br>
                                        R$ <?=number_format($item['preco_unit'], 2, ',', '.') ?>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </section>
                    </div>

                    <div class="pedido-coluna">
                        <section class="pedido-bloco">
                            <h2>Status:</h2>
                            <ul class="pedido-status">
                                <?php 
                                    $statusAtual = $pedido['status_pe'];
                                    $statusRealizado = "Realizado";
                                    $statusPagamento = ($pedido['status_pag'] === 'Aprovado') ? "Pagamento aprovado" : "Pagamento pendente";
                                    $statusEnviado = ($statusAtual === 'Enviado' || $statusAtual === 'Entregue') ? "Enviado" : "Enviado";
                                    $statusEntregue = ($statusAtual === 'Entregue') ? "✓ Entregue" : "Entregue";
                                ?>
                                <li class="status-atual"><?= $statusRealizado ?></li>
                                <li class="status-atual"><?= $statusPagamento ?></li>
                                <li class="status-atual"><?= $statusEnviado ?></li>
                                <li class="status-pendente"><?= $statusEntregue ?></li>
                            </ul>
                        </section>

                        <section class="pedido-bloco">
                            <h2>Pagamento:</h2>
                            <p><?=strtoupper(htmlspecialchars($pedido['metodo_pag'] ?? 'Não informado')) ?></p>
                        </section>

                        <section class="pedido-bloco">
                            <h2>Total:</h2>
                            <p>R$ <?=number_format($pedido['valor_total'], 2, ',', '.')?></p>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
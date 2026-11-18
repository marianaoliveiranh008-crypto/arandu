<?php
    session_start();
    require_once "../../config/database.php";

    $id_pedido = $_GET['id'] ?? null;
    if(!$id_pedido){
        die("Erro: Pedido não especificado.");
    }

    $sqlUp = "UPDATE pagamento SET status_pag = 'Aprovado' WHERE id_ped = ?";
    $stmtUp = $conexao->prepare($sqlUp);
    $stmtUp->bind_param("i", $id_pedido);
    $stmtUp->execute();
    $stmtUp->close();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $sqlEnvio = "UPDATE pedido SET status_pe = 'Enviado'
                     WHERE id_ped = ?";
        $stmtEnvio = $conexao->prepare($sqlEnvio);
        $stmtEnvio->bind_param("i", $id_pedido);
        $stmtEnvio->execute();$stmtEnvio->close();
        header("Location: detalhesPedidos.php?id=" . $id_pedido);
        exit;
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
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes dos pedidos - Arandu</title>
    <link rel="stylesheet" href="../../css/style.css?v=9">
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
                                    $pagamentoAprovado = (($pedido['status_pag'] ?? '') === 'Aprovado');
                                    $statusRealizado = "Realizado";
                                    $statusPagamento = $pagamentoAprovado ? "Pagamento aprovado" : "Pagamento pendente";
                                    $foiEnviado = $pagamentoAprovado && ($statusAtual === 'Enviado' || $statusAtual === 'Entregue');
                                    $statusEnviado = $foiEnviado ? "Enviado" : "Aguardando envio";
                                    $foiEntregue = $pagamentoAprovado && ($statusAtual === 'Entregue');
                                    $statusEntregue = $foiEntregue ? "Entregue" : "Entregue";
                                ?>
                                <li class="status-atual"><?= $statusRealizado ?></li>
                                <li class="<?=$pagamentoAprovado ? 'status-atual' : 'status-pendente'?>"><?= $statusPagamento ?></li>
                                <li class="<?=$foiEnviado ? 'status-atual' : 'status-pendente'?>"><?= $statusEnviado ?></li>
                                <li class="<?=$foiEntregue ? 'status-atual' : 'status-pendente'?>"><?= $statusEntregue ?></li>
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
                        
                        <form method="POST" class="perfil-acoes">
                            <button type="submit">Enviar pedido</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>